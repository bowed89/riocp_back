<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoErroresRevision extends Model
{
    use HasFactory;
    protected $table = 'tipo_errores_revision';
    protected $fillable = [
        'tipo_errores',
        'estado',
    ];
}
