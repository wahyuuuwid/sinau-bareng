<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
//     public function generateSoal(Request $request)
// {
//     $request->validate([
//         'file_materi' => 'required|mimes:pdf|max:10240',
//         'jenis_soal' => 'required|array'
//     ]);

//     try {
//         $parser = new Parser();
//         $pdf = $parser->parseFile($request->file('file_materi')->path());
        
//         // Bersihkan teks dari karakter malformed UTF-8
//         $rawText = $pdf->getText();
//         $fullText = preg_replace('/[^\x20-\x7E\t\n\r]/', '', $rawText); 

//         // Pastikan name-nya sama dengan di blade (biasanya perintah_tambahan)
//         $perintahUser = $request->input('perintah_tambahan', ''); 
//         $jenis = implode(', ', $request->jenis_soal);

//         // Buat instruksi yang lebih tegas
//         $instruksi = !empty($perintahUser) 
//             ? "Jawab pertanyaan user ini: '{$perintahUser}' secara mendalam."
//             : "Buatkan 3 soal kuis tipe {$jenis}.";

//         $prompt = "Kamu adalah asisten dosen yang pintar. Gunakan MATERI berikut sebagai satu-satunya referensi.\n\n" .
//                 "TUGAS: {$instruksi}\n\n" .
//                 "MATERI:\n{$fullText}";

//         $apiKey = env('GEMINI_API_KEY');
        
//         $response = Http::withHeaders([
//             'x-goog-api-key' => $apiKey,
//             'Content-Type' => 'application/json'
//         ])
//         ->timeout(240)
//         ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent", [
//             'contents' => [['parts' => [['text' => $prompt]]]]
//         ]);

//         $result = $response->json();
//         $soal = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'AI tidak memberikan jawaban.';

//         return back()->with('hasil_soal', $soal);

//     } catch (\Exception $e) {
//         return back()->with('error', 'Error: ' . $e->getMessage());
//     }
// }

    public function generateSoal(Request $request)
    {
        $request->validate([
            'file_materi' => 'required|mimes:pdf|max:10240',
            'jenis_soal' => 'required|array'
        ]);

        try {
            // PARSE PDF
            $parser = new Parser();
            $pdf = $parser->parseFile($request->file('file_materi')->path());

            $rawText = $pdf->getText();

            // CLEAN TEXT
            $cleanText = mb_convert_encoding($rawText, 'UTF-8', 'UTF-8');

            $cleanText = str_replace([
                '-', '—', '“', '”', '`', '#', '…'
            ], [
                '-', '-', '"', '"', "'", "'", '...'
            ], $cleanText);

            $cleanText = preg_replace('/[^\x20-\x7E\n\r\t]/u', '', $cleanText);

            // Batasi panjang 
            $fullText = substr($cleanText, 0, 3000);

            // 3. INPUT USER
            $perintahUser = $request->input('perintah_tambahan', '');
            $jenis = implode(', ', $request->jenis_soal);

            $instruksi = !empty($perintahUser)
                ? "Jawab pertanyaan berikut secara singkat dan jelas: {$perintahUser}"
                : "Buatkan 3 soal kuis tipe {$jenis} beserta jawabannya secara singkat.";

            // PROMPT 
            $prompt = "Jawab dengan jelas dan singkat pertanyaan user ini s.\n\n" .
                        "TUGAS: {$instruksi}\n\n" .
                        "MATERI:\n{$fullText}";


            // API GROQ

            $apiKey = env('GROQ_API_KEY');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])
            ->timeout(240)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                "model" => "openai/gpt-oss-120b",
                "messages" => [
                    [
                        "role" => "system",
                        "content" => "Kamu adalah asisten dosen. Jawaban harus singkat, jelas, dan langsung ke inti."
                    ],
                    [
                        "role" => "user",
                        "content" => $prompt
                    ]
                ],
                "temperature" => 0.7,
                "max_completion_tokens" => 512
            ]);

            $result = $response->json();

            // HANDLE RESPONSE
            if (isset($result['choices'][0]['message']['content'])) {
                $soal = $result['choices'][0]['message']['content'];
            } else {
                // Debug kalau error
                $soal = "ERROR RESPONSE:\n" . json_encode($result, JSON_PRETTY_PRINT);
            }

            return back()->with('hasil_soal', $soal);

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
