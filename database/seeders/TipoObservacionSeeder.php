<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoObservacionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipos_observaciones')->insert([
            [
                'enumeracion' => '1',
                'observacion' =>
                'Carta de solicitud dirigida a la Viceministra
                del Tesoro y Crédito Público, suscrita por la Maxima
                Autoridad Ejecutiva (MAE).',
            ],
            [
                'enumeracion' => '2',
                'observacion' =>
                'Formulario 1 de “Solicitud de Registro de Inicio de
                Operaciones de Crédito Público”, en el que se describen
                las características principales de la operación de crédito
                público que se solicita iniciar (uno por acreedor).',
            ],
            [
                'enumeracion' => '2.1',
                'observacion' =>
                'Anexo: Cronograma de Pagos.',
            ],
            [
                'enumeracion' => '2.2',
                'observacion' =>
                'Anexo: Cronograma de Desembolsos.',
            ],

            [
                'enumeracion' => '3',
                'observacion' =>
                'Formulario 2 de “Información de Deuda”.',
            ],
            [
                'enumeracion' => '3.1',
                'observacion' =>
                'Anexo: Certificado no Vigente.(Anexo del formulario 2 de la pregunta 4)',
            ],
            [
                'enumeracion' => '4',
                'observacion' =>
                'Formulario 3 de “Cronograma del Servicio de la Deuda”.',
            ],
            [
                'enumeracion' => '5',
                'observacion' =>
                'Formulario 4 de “Cronograma de Desembolsos Programados y/o Estimados”.',
            ]
        ]);
    }
}
