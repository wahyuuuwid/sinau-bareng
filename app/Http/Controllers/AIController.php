<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function generateSoal(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'file_materi' => 'required|mimes:pdf|max:10240', // Maks 10MB
            'jenis_soal' => 'required|array'
        ]);

        try {
            // 2. Ekstrak teks dari PDF
            $parser = new Parser();
            $pdf = $parser->parseFile($request->file('file_materi')->path());
            $text = $pdf->getText();
            
            // Batasi teks biar gak kepanjangan (biar hemat kuota API)
            $cleanText = substr($text, 0, 5000); 

            // 3. Susun Perintah (Prompt)
            $jenis = implode(', ', $request->jenis_soal);
            //$prompt = "Kamu adalah pakar edukasi. Berdasarkan teks materi di bawah ini, buatkan 3 soal dengan tipe: {$jenis}. \n\n MATERI: \n {$cleanText} \n\n Format output harus teks yang rapi dan mudah dibaca.";

            //$prompt = "Halo Gemini, tes koneksi dong. Jawab 'Gacor' kalau kamu denger saya.";
            $prompt = "Tes koneksi. Jawab 'OK' saja.";

            // 4. Manggil API Gemini
       // Pastikan variabel $apiKey sudah benar dari .env
            $apiKey = config('services.gemini.key') ?? env('GEMINI_API_KEY');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post("https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=" . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            $result = $response->json();

            // DEBUG LAGI: Kalau masih error, kita intip isinya
            if (isset($result['error'])) {
                dd([
                    'Pesan_Error' => $result['error']['message'],
                    'Status' => $result['error']['status'],
                    'Saran' => 'Coba cek apakah API Key di .env sudah sama persis dengan di Google AI Studio'
                ]);
            }
            
            // Ambil teks jawaban dari Gemini
            $soal = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, AI gagal generate soal.';

            return back()->with('hasil_soal', $soal);

        } catch (\Exception $e) {
            //return back()->with('error', 'Waduh error: ' . $e->getMessage());
            dd($e->getMessage());
        }
    }
}