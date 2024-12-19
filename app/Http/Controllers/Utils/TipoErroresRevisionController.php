<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use App\Models\TipoErroresRevision;

class TipoErroresRevisionController extends Controller
{
    public function index()
    {
        $tipoErrores = TipoErroresRevision::all();

        if ($tipoErrores->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No hay tipo de errores disponibles.',
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Listado de tipo de errores.',
            'data' => $tipoErrores,
        ], 200);
    }

}
