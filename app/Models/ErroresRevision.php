<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErroresRevision extends Model
{
    use HasFactory;
    protected $table = 'errores_revision';
    protected $fillable = [
        'comentario',
        'usuario_revisor_id',
        'usuario_error_id',
        'solicitud_id',
        'tipo_error_id'
    ];
}
