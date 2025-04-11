<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OcrController extends Controller
{
    public function lerMatricula(Request $request)
    {
        $data = $request->input('image');

        if (!$data) {
            return response()->json(['error' => 'Imagem não fornecida'], 400);
        }

        // Decodificar a imagem base64
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));

        // Salvar temporariamente a imagem (opcional)
        $filename = storage_path('app/temp_ocr.jpg');
        file_put_contents($filename, $image);

        $tempBW = storage_path('app/temp_ocr_bw.jpg');
        exec("convert $filename -colorspace Gray -threshold 50% $tempBW");
        exec("tesseract $tempBW stdout", $output, $returnVar);

        // Aqui deverias usar uma biblioteca OCR (tipo Tesseract via Shell ou um pacote PHP)
        // Exemplo com tesseract instalado:
        $output = null;
        $returnVar = null;
        exec("tesseract $filename stdout", $output, $returnVar);

        if ($returnVar !== 0) {
            return response()->json(['error' => 'Erro no OCR'], 500);
        }

        $text = trim(implode(" ", $output));

        if (!$text) {
            return response()->json(['error' => 'Texto não lido'], 500);
        }
        
        return response()->json(data: ['text' => $text]);
        
    }
}
