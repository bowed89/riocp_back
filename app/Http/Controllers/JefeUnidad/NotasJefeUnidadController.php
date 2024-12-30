<?php

namespace App\Http\Controllers\JefeUnidad;

use App\Http\Controllers\Controller;
use App\Http\Services\JefeUnidad\NotasJefeUnidadService;

class NotasJefeUnidadController extends Controller
{
    protected $notasJefeUnidadService;

    public function __construct(NotasJefeUnidadService $notasJefeUnidadService)
    {
        $this->notasJefeUnidadService = $notasJefeUnidadService;
    }

    public function verNotasJefeUnidad($solicitudId)
    {
        $response = $this->notasJefeUnidadService->verNotasJefeUnidad($solicitudId);
        return response()->json($response['data'], $response['status']);
    }
}
