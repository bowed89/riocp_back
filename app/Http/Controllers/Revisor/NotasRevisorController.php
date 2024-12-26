<?php

namespace App\Http\Controllers\Revisor;

use App\Http\Controllers\Controller;
use App\Http\Services\Revisor\NotasRevisorService;

class NotasRevisorController extends Controller
{
    protected $notasRevisorService;

    public function __construct(NotasRevisorService $notasRevisorService)
    {
        $this->notasRevisorService = $notasRevisorService;
    }

    public function verNotasRevisor($solicitudId)
    {
        $response = $this->notasRevisorService->verNotasRevisor($solicitudId);
        return response()->json($response['data'], $response['status']);
    }
}
