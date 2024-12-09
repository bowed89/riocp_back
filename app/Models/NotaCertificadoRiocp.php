<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaCertificadoRiocp extends Model
{
    use HasFactory;
    protected $table = 'notas_certificado_riocp';
    protected $fillable = [
        'fecha',
        'nro_nota',
        'header',
        'referencia',
        'body',
        'remitente',
        'revisado',
        'certificado_riocp_id'
    ];
}
