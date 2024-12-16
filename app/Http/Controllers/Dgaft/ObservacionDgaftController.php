<?php

namespace App\Http\Controllers\Dgaft;

use App\Http\Controllers\Controller;
use App\Http\Services\Dgaft\ObservacionDgaftService;

class ObservacionDgaftController extends Controller
{
    protected $observacionDgaftService;

    public function __construct(ObservacionDgaftService $observacionDgaftService)
    {
        $this->observacionDgaftService = $observacionDgaftService;
    }

    public function verObservacionIdSolicitud($solicitudId)
    {
        $response = $this->observacionDgaftService->verObservacionDgaft($solicitudId);
        return response()->json($response['data'], $response['status']);
    }
}
