<?php

namespace App\Http\Services\Operador;

use App\Http\Services\Utils\GenerarNotaAprobadoRiocp;
use App\Http\Services\Utils\GenerarNotaObservacionRiocp;
use App\Http\Services\Utils\GenerarNotaRechazoRiocp;
use App\Http\Services\Utils\GenerarNotasRiocp;
use App\Models\NotaCertificadoRiocp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use stdClass; 

class NotaRiocpService
{
    // GUARDO CERTIFICADO RIOCP NO APROBADO
    public function almacenarNota($request, $user)
    {
        $almacenarNota = new NotaCertificadoRiocp();
        //$almacenarNota->fill($request);
        $almacenarNota->fill($request->all());
        $almacenarNota->usuario_id = $user->id;
        $almacenarNota->rol_id = $user->rol_id;
        $almacenarNota->save();
    }

    public function verNotaRechazo($solicitudId, $sd, $vpd)
    {
        $user = Auth::user();

        if (!$user) {
            return [
                'status' => false,
                'message' => 'Usuario no autorizado o sin rol asignado.'
            ];
        }

        // llamo el query para obtener mi codigo_entidad
        $certificadoRiocpService = new CertificadoRiocpService();
        $query = $certificadoRiocpService->obtenerSolicitudCertificado($solicitudId);

        if (!$query) {
            return [
                'status' => false,
                'message' => 'No se encontraron solicitudes.'
            ];
        }

        $generarNota = new GenerarNotaRechazoRiocp();

        $body = new stdClass();
        /*  $body->fechaActual = $generarNota->fechaActualNota(); //header
        $body->destinatarioNota = $generarNota->destinatarioNota($solicitudId); //header */
        $body->fecha = $generarNota->fechaActualNota();
        $body->nro_nota = $generarNota->nroNota();

        $body->header = $generarNota->destinatarioNota($solicitudId);

        $body->referencia = $generarNota->Referencia();

        $body->body = $generarNota->body($solicitudId, $sd, $vpd);
        $body->remitente = $generarNota->remitente();
        $body->revisado = $generarNota->revisado();

        return [
            'status' => true,
            'data' => $body,
            'message' => 'Nota solicitada.'
        ];
    }

    public function verNotaAprobado($solicitudId)
    {

        $user = Auth::user();

        if (!$user) {
            return [
                'status' => false,
                'message' => 'Usuario no autorizado o sin rol asignado.'
            ];
        }

        // llamo el query para obtener mi codigo_entidad
        $certificadoRiocpService = new CertificadoRiocpService();
        $query = $certificadoRiocpService->obtenerSolicitudCertificado($solicitudId);

        if (!$query) {
            return [
                'status' => false,
                'message' => 'No se encontraron solicitudes.'
            ];
        }

        $generarNota = new GenerarNotaAprobadoRiocp();

        $body = new stdClass();

        $body->fecha = $generarNota->fechaActualNota();
        $body->nro_nota = $generarNota->nroNota();

        $body->header = $generarNota->destinatarioNota($solicitudId);

        $body->referencia = $generarNota->Referencia();


        $body->body = $generarNota->body($solicitudId);
        $body->remitente = $generarNota->remitente();
        $body->revisado = $generarNota->revisado();

        return [
            'status' => true,
            'data' => $body,
            'message' => 'Nota solicitada.'
        ];
    }


    public function verNotaObservacion($solicitudId)
    {
        $user = Auth::user();

        if (!$user) {
            return [
                'status' => false,
                'message' => 'Usuario no autorizado o sin rol asignado.'
            ];
        }

        // llamo el query para obtener mi codigo_entidad
        $certificadoRiocpService = new CertificadoRiocpService();
        $query = $certificadoRiocpService->obtenerSolicitudCertificado($solicitudId);

        if (!$query) {
            return [
                'status' => false,
                'message' => 'No se encontraron solicitudes.'
            ];
        }


        $generarNota = new GenerarNotaObservacionRiocp();

        $body = new stdClass();

        $body->fecha = $generarNota->fechaActualNota();
        $body->nro_nota = $generarNota->nroNota();

        $body->header = $generarNota->destinatarioNota($solicitudId);

        $body->referencia = $generarNota->Referencia();



        $body->body = $generarNota->body($solicitudId);
        $body->remitente = $generarNota->remitente();
        $body->revisado = $generarNota->revisado();

        return [
            'status' => true,
            'data' => $body,
            'message' => 'Nota solicitada.'
        ];
    }
}
