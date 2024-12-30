<?php

namespace App\Http\Services\Utils;

use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\View;

class PdfService
{
    public function generarHtml($datos)
    {
        return View::make('pdf.formulario1', compact('datos'))->render();
    }

    public function generarNotaObservacionHtml($datos)
    {
        return View::make('pdf.notas.nota-observacion', compact('datos'))->render();
    }



    public function generarPdf($html)
    {
        return Browsershot::html($html)
            ->setOption('args', ['--no-sandbox', '--disable-setuid-sandbox'])
            ->showBackground()
            ->margins(0, 0, 0, 0)
            ->pdf();
    }

    /*  public function procesarTexto($text)
    {
        $paragraphs = explode('De mi consideración:', $text);

        $paragraphs = array_map(function ($paragraph) {
            return trim($paragraph) ? "De mi consideración:" . $paragraph : $paragraph;
        }, $paragraphs);

        // Verificar si existe el segundo párrafo antes de acceder a él
        if (isset($paragraphs[1])) {
            Log::debug('texto procesado ==>' . json_encode($paragraphs[1]));
            return $paragraphs[1]; // Devolver el párrafo procesado
        }

        // Si no existe, devolver el texto original o un valor por defecto
        Log::debug('texto procesado no encontrado, devolviendo texto original');
        return $text;
    } */

    public function procesarTexto($text)
    {
        // Formatear el primer caso
        $paragraphs1 = explode('De mi consideración:', $text);
        $formattedText1 = implode("De mi consideración:<br><br>", array_map('trim', $paragraphs1));

        // Formatear el segundo caso
        $paragraphs2 = explode('solicitud de certificado de Registro de Inicio de Operaciones de Crédito Público (RIOCP).', $formattedText1);
        $formattedText2 = implode("solicitud de certificado de Registro de Inicio de Operaciones de Crédito Público (RIOCP).<br><br>", array_map('trim', $paragraphs2));

        Log::debug('Texto procesado ==> ' . $formattedText2);
        return $formattedText2;
    }

    private function example($datos)
    {
        $datos['body'] = nl2br($datos['body']); // Convierte \n a <br> si no está hecho
        $datos['body'] = str_replace('<br>', '</p><p>', $datos['body']); // Convierte <br> en bloques de párrafos
        return $datos['body'] = '<p>' . $datos['body'] . '</p>'; // Encierra todo en un bloque <p>
    }
}
