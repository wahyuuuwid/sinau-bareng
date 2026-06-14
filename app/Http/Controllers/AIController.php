<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    /**
     * Memproses file PDF dan prompt untuk dikirim ke Gemini AI
     */
    public function generateSoal(Request $request)
    {
        // 1. Validasi Input dari form
        $request->validate([
            'file_materi' => 'required|file|mimes:pdf|max:10240', // Maksimal 10MB
            'jenis_soal' => 'nullable|array',
            'perintah_tambahan' => 'nullable|string|max:500',
        ]);

        // 2. Ambil API Key dari .env
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return back()->with('error', 'Sistem error: API Key Gemini belum diatur.');
        }

        try {
            // 3. Konversi file PDF menjadi string Base64
            $file = $request->file('file_materi');
            $pdfBase64 = base64_encode(file_get_contents($file->getRealPath()));

            // 4. Susun instruksi (Prompt) berdasarkan input user
            $jenis = $request->has('jenis_soal') ? implode(', ', $request->jenis_soal) : 'Pilihan Ganda';
            $tambahan = $request->perintah_tambahan ? " Instruksi tambahan: " . $request->perintah_tambahan : "";
            
            $prompt = "Berdasarkan dokumen PDF terlampir, buatkan soal-soal latihan. Jenis soal yang diminta: {$jenis}. {$tambahan}. Berikan jawaban menggunakan bahasa Indonesia yang rapi, informatif, dan langsung ke intinya (tanpa basa-basi).";

            // 5. Tembak API Gemini 2.5 Flash menggunakan HTTP Client Laravel
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}";

            $response = Http::timeout(60)->withHeaders([
                'Content-Type' => 'application/json'
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                            [
                                'inlineData' => [
                                    'mimeType' => 'application/pdf',
                                    'data' => $pdfBase64
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            // 6. Tangani Response dari Google
            if ($response->successful()) {
                // Ambil hasil teks dari struktur JSON Google
                $result = $response->json('candidates.0.content.parts.0.text');
                
                // Kembalikan ke halaman generate.blade.php dengan membawa data session
                return back()->with('hasil_soal', $result);
            } else {
                // Jika Google menolak/error
                $errorMsg = $response->json('error.message') ?? 'Gagal memproses data dari API.';
                return back()->with('error', 'Error AI: ' . $errorMsg);
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}