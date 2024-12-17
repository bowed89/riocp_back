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
        Log::debug('body antes ==>' . json_encode($datos));

        $datos['body'] = $this->procesarTexto($datos['body']);
        Log::debug('body despues ==>' . json_encode($datos));

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
        // Dividir y reconstruir con etiquetas HTML
        $paragraphs = explode('De mi consideración:', $text);
        $formattedText = implode("De mi consideración:<br><br>", array_map('trim', $paragraphs));

        Log::debug('Texto procesado ==> ' . $formattedText);
        return $formattedText;
    }
}
