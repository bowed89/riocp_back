<?php

namespace App\Http\Controllers\JefeUnidad;

use App\Http\Controllers\Controller;
use App\Http\Services\JefeUnidad\VerObservacionRevisorService;

class VerObservacionRevisorController extends Controller
{
    protected $observacionRevisorService;

    public function __construct(VerObservacionRevisorService $observacionRevisorService)
    {
        $this->observacionRevisorService = $observacionRevisorService;
    }
    
    public function verObservacionIdSolicitud($solicitudId)
    {
        $response = $this->observacionRevisorService->verObservacionRevisor($solicitudId);
        return response()->json($response['data'], $response['status']);
    }

}
