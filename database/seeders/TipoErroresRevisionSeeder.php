<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoErroresRevisionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_errores_revision')->insert([
            ['tipo_errores' => 'Observaciones'],
            ['tipo_errores' => 'Notas'],
            ['tipo_errores' => 'Certificado RIOCP'],
            ['tipo_errores' => 'Otros']
        ]);
    }
}
