<?php

namespace App\Http\Services\Operador;

use App\Events\Notificaciones;
use App\Http\Queries\JefeUnidadQuery;
use App\Models\Observacion;
use App\Models\Seguimientos;
use App\Models\Solicitud;
use App\Models\TipoObservaciones;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ObservacionTecnicoService
{
    public function guardarObservaciones($request)
    {
        Log::debug('REQUEST +++: ' . json_encode($request->all()));

        $certificadoRiocpService = new CertificadoRiocpService();

        $user = Auth::user();
        if (!$user) {
            return [
                'status' => false,
                'message' => 'Usuario no autorizado o sin rol asignado.'
            ];
        }
        // Obtengo el id de la solicitud incompleta del usuario
        $solicitud = Solicitud::where('id', $request->solicitud_id)
            ->where('estado_solicitud_id', 1) // 1 es incompleto
            ->first();

        if (!$solicitud) {
            return [
                'status' => 404,
                'data' => [
                    'status' => false,
                    'message' => 'No se encontro una solicitud del usuario en proceso. Primero debe completar el FORMULARIO 1 SOLICITUD RIOCP.'
                ]
            ];
        }

        // Verifico que no existan registros creados anteriormente
        $observacionesDuplicadas = Observacion::where('solicitud_id', $solicitud->id)
            ->where('usuario_id', $user->id)
            ->where('rol_id', $user->rol_id)
            ->get();

        if ($observacionesDuplicadas->isNotEmpty()) {
            return [
                'status' => 404,
                'data' => [
                    'status' => false,
                    'message' => 'Ya se registro observaciones con una solicitud pendiente.'
                ]
            ];
        }

        // Actualizo segumiento y agrego nuevo seguimiento para el siguiente rol
        $this->asignarSeguimiento($request, $user);

        // registro las observaciones
        foreach ($request['observaciones'] as $observacion) {
            $newObservacion = new Observacion();
            $newObservacion->cumple = $observacion['cumple'];
            $newObservacion->observacion = $observacion['observacion'];
            $newObservacion->tipo_observacion_id = $observacion['tipo_observacion_id'];
            $newObservacion->solicitud_id = $solicitud->id;
            $newObservacion->usuario_id = $user->id;
            $newObservacion->rol_id = $user->rol_id;
            $newObservacion->save();
        }

        // ASIGNO LOS CERTIFICADOS RIOCPS CON SUS NOTAS...
        // tiene observacion
        if ($request['esObservado']) {
            Log::debug('entraa esObservado');
            $certificadoRiocpService->guardarObservado($request, $user);
        } else {
            Log::debug('no entraa esObservado');
            // Almaceno REGISTRO CERTIFICADO APROBADO O RECHAZADO
            $certificadoRiocpService->guardarAprobadoRechazado($request, $user);
        }

        // actualizar el estado de requisitos y agregar nro de hoja de ruta
        $actualizarSolicitud = Solicitud::where('id', $request['solicitud_id'])->first();

        if (!$actualizarSolicitud) {
            return [
                'status' => false,
                'message' => 'No existe una solicitud.'
            ];
        }
        $actualizarSolicitud->nro_hoja_ruta = $request['nro_hoja_ruta'];
        $actualizarSolicitud->estado_requisito_id = 2;
        $actualizarSolicitud->save();

        // Event para notificaciones de nuevos tramites
        $this->emitNotificacion($user);

        return [
            'status' => 200,
            'data' => [
                'status' => true,
                'message' => 'Se registraron las observaciones correctamente.'
            ]
        ];
    }

    private function emitNotificacion($user)
    {
        $resultados = JefeUnidadQuery::getJefeUnidadList($user);
        $count = 0;
        foreach ($resultados as $res) {
            if ($res['estado'] == 'SIN DERIVAR') {
                $count += 1;
            }
        }
        event(new Notificaciones($count));
    }

    private function asignarSeguimiento($data, $user)
    {
        // actualizar seguimiento
        $seguimientoOrigen = Seguimientos::where('id', $data->id_seguimiento)->first();

        if (!$seguimientoOrigen) {
            return [
                'status' => false,
                'message' => 'No existe un seguimiento origen.'
            ];
        }

        $seguimientoOrigen->estado_derivado_id = 2;
        $seguimientoOrigen->observacion = $data['observacion'];
        $seguimientoOrigen->fecha_derivacion = Carbon::now();
        $seguimientoOrigen->save();

        // agregar seguimiento para la proxima unidad

        // Agregar seguimiento para la próxima unidad
        $seguimientoProximaUnidad = Seguimientos::where('solicitud_id', $data['solicitud_id'])
            ->where('usuario_origen_id', $user->id)
            ->where('usuario_destino_id', $data->usuario_destino_id)
            ->first();

        if ($seguimientoProximaUnidad) {
            return [
                'status' => false,
                'message' => 'Ya existe un seguimiento agregado a la próxima unidad.'
            ];
        }

        $seguimiento = new Seguimientos();
        $seguimiento->solicitud_id = $data['solicitud_id'];
        $seguimiento->usuario_origen_id = $user->id;
        $seguimiento->usuario_destino_id = $data['usuario_destino_id'];
        $seguimiento->estado_derivado_id = 1;
        $seguimiento->save();
    }

    public function verTipoObservaciones()
    {
        $user = Auth::user();
        if (!$user) {
            return [
                'status' => 401,
                'data' => [
                    'status' => false,
                    'message' => 'Usuario no autorizado o sin rol asignado.'
                ]
            ];
        }

        $tipoObservaciones = TipoObservaciones::orderBy('enumeracion', 'asc')->get();

        if ($tipoObservaciones->isEmpty()) {
            return [
                'status' => 404,
                'data' => [
                    'status' => false,
                    'message' => 'No se encontraron tipo de observaciones.'
                ]
            ];
        }

        return [
            'status' => 200,
            'data' => [
                'status' => true,
                'message' => 'Listado de seguimientos.',
                'data' => $tipoObservaciones,
            ]
        ];
    }
}
