<?php

namespace App\Http\Services\JefeUnidad;

use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotasJefeUnidadService
{
    public function verNotasJefeUnidad($solicitudId)
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

        $solicitud = Solicitud::where('id', $solicitudId)
            ->first();

        if (!$solicitud) {
            return [
                'status' => 401,
                'data' => [
                    'status' => false,
                    'message' => 'No existe una solicitud con el ID enviado.'
                ]
            ];
        }


        $notas = DB::table('notas_certificado_riocp AS n')
            ->join('certificados_riocp AS c', 'n.certificado_riocp_id', '=', 'c.id')
            ->join('solicitudes AS s', 'c.solicitud_id', '=', 's.id')
            ->where('n.rol_id', 4) // rol de jefe unidad
            ->where('s.id', $solicitudId)
            ->select([
                'n.fecha',
                'n.nro_nota',
                'n.header',
                'n.referencia',
                'n.body',
                'n.remitente',
                'n.revisado',
            ])
            ->first();

        if (!$notas) {
            return [
                'status' => 404,
                'data' => [
                    'status' => false,
                    'message' => 'No se encontro una nota con la solicitud o con el rol revisor requerida.'
                ]
            ];
        }

        return [
            'status' => 200,
            'data' => [
                'status' => true,
                'message' => 'Listado nota de observación.',
                'data' => $notas,
            ]
        ];
    }
}
