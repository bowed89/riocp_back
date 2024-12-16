<?php

namespace App\Http\Controllers\Dgaft;

use App\Http\Controllers\Controller;
use App\Http\Services\Dgaft\NotasDgaftService;

class NotasDgaftController extends Controller
{
    protected $notasDgaftService;

    public function __construct(NotasDgaftService $notasDgaftService)
    {
        $this->notasDgaftService = $notasDgaftService;
    }

    public function verNotasDgaft($solicitudId)
    {
        $response = $this->notasDgaftService->verNotasDgaft($solicitudId);
        return response()->json($response['data'], $response['status']);
    }
}
