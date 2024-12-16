<?php

namespace App\Http\Services\Dgaft;

use App\Models\Observacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ObservacionDgaftService
{
    public function verObservacionDgaft($solicitudId)
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

        $observaciones = DB::table('tipos_observaciones as tobs')
            ->join('observaciones as ob', 'tobs.id', '=', 'ob.tipo_observacion_id')
            ->select('tobs.observacion as tipo_observacion', 'tobs.enumeracion', 'ob.observacion', 'ob.cumple', 'tobs.id as tipo_observacion_id' )
            ->where('ob.solicitud_id', $solicitudId)
            ->where('ob.rol_id', 4) // obtengo del rol revisor
            ->orderBy('tobs.enumeracion', 'asc')
            ->get();

        if ($observaciones->isEmpty()) {
            return [
                'status' => 404,
                'data' => [
                    'status' => false,
                    'message' => 'No se encontraron observaciones.'
                ]
            ];
        }

        return [
            'status' => 200,
            'data' => [
                'status' => true,
                'message' => 'Listado de observaciones.',
                'data' => $observaciones,
            ]
        ];
    }
}
