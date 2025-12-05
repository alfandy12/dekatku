<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatService
{
    private string $apiKey;
    private string $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
    private string $model = 'llama-3.3-70b-versatile';

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key');
        
       
        if (empty($this->apiKey)) {
            Log::warning('Groq API Key is not set!');
        }
    }

    private function buildSystemPrompt(array $nearbyStores, ?array $userLocation = null): string
    {
        $storeContext = '';
        if (!empty($nearbyStores)) {
            foreach ($nearbyStores as $index => $store) {
                $num = $index + 1;
                $products = isset($store['products']) && count($store['products']) > 0
                    ? collect($store['products'])->pluck('title')->implode(', ')
                    : 'Lihat toko untuk detail produk';

                $storeContext .= "{$num}. {$store['nama_toko']}\n";
                $storeContext .= "   - Jarak: {$store['jarak']}\n";
                $storeContext .= "   - Tipe: {$store['type']}\n";
                $storeContext .= "   - Produk: {$products}\n";
                $storeContext .= "   - Deskripsi: {$store['description']}\n";
                $storeContext .= "   - Link: /umkm/{$store['slug']}\n\n";
            }
        } else {
            $storeContext = 'Belum ada toko terdekat yang terdaftar.';
        }

        $locationInfo = $userLocation
            ? "Lokasi: {$userLocation['address']}"
            : "Lokasi belum diaktifkan";

        return <<<PROMPT
Kamu adalah asisten AI bernama "Dekatku Assistant" untuk platform marketplace UMKM lokal Indonesia.

INFORMASI PLATFORM:
- Nama Platform: Dekatku
- Pendaftaran UMKM: GRATIS (100% gratis, tanpa biaya apapun)
- Fitur: Katalog produk, jasa, pencarian toko UMKM terdekat
- Misi: Membantu UMKM lokal berkembang dengan teknologi
- Fitur: disisi user, website ini akan menemukan umkm terdekat dari lokasi user

LOKASI USER SAAT INI:
{$locationInfo}

TOKO UMKM TERDEKAT (diurutkan dari terdekat):
{$storeContext}

TUGAS KAMU:
1. Bantu user menemukan toko/produk/jasa UMKM yang sesuai kebutuhan
2. Berikan rekomendasi berdasarkan jarak dan relevansi
3. Jawab pertanyaan tentang toko (produk, jasa, deskripsi, lokasi)
4. Jawab pertanyaan umum tentang platform (cara daftar, biaya, dll)
5. Gunakan bahasa Indonesia yang ramah, natural, dan membantu
6. Jika user tertarik dengan toko, arahkan ke link toko

ATURAN PENTING:
- Selalu sebutkan jarak toko dari user
- Jangan membuat data toko yang tidak ada dalam list
- Jika tidak ada toko yang cocok, sarankan alternatif terdekat
- Jika user menanyakan cara ke toko, sarankan menggunakan Google Maps
- Untuk detail lengkap toko, arahkan user ke link toko (/umkm/[slug])
- Jangan Pernah Menjawab pertanyaan diluar konteks, hanya untuk website ini
- Cukup Tolak dan katakan saya tidak dilatih untuk itu jika ada pertanyaan diluar konteks

CONTOH INTERAKSI BAIK:
User: "Ada toko yang jual makanan?"
Assistant: "Ada! Berdasarkan lokasi kamu, ada [Nama Toko] yang berjarak [jarak] menjual [produk]. Toko ini juga menyediakan [produk lain]. Mau lihat detail lengkapnya? Kamu bisa kunjungi halaman tokonya."

User: "Berapa biaya daftar UMKM?"
Assistant: "Pendaftaran UMKM di Dekatku 100% GRATIS! Tidak ada biaya apapun. Cukup daftar, verifikasi toko kamu, dan langsung bisa mulai berjualan. Proses verifikasi biasanya selesai dalam 1-2 hari kerja."

GAYA BAHASA:
- Ramah tapi profesional
- Tidak terlalu formal
- Gunakan emoji sesekali untuk friendly vibes
- Singkat tapi informatif
- Fokus membantu user menemukan yang mereka cari
PROMPT;
    }

    public function chat(string $userMessage, array $context = []): array
    {
        try {
            $nearbyStores = $context['nearby_stores'] ?? [];
            $userLocation = $context['user_location'] ?? null;

            $systemPrompt = $this->buildSystemPrompt($nearbyStores, $userLocation);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage,
                    ],
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
                'top_p' => 1,
            ]);

            if ($response->failed()) {
                Log::error('Groq API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                throw new \Exception('Failed to get response from AI');
            }

            $data = $response->json();

            return [
                'success' => true,
                'message' => $data['choices'][0]['message']['content'] ?? 'Maaf, tidak ada respon.',
            ];
        } catch (\Exception $e) {
            Log::error('Chat Service Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Maaf, terjadi kesalahan saat memproses pesan Anda. Silakan coba lagi.',
                'error' => $e->getMessage(),
            ];
        }
    }

    public function chatWithHistory(array $messages, array $context = []): array
    {
        try {
            $nearbyStores = $context['nearby_stores'] ?? [];
            $userLocation = $context['user_location'] ?? null;

            $systemPrompt = $this->buildSystemPrompt($nearbyStores, $userLocation);

            $allMessages = array_merge([
                [
                    'role' => 'system',
                    'content' => $systemPrompt,
                ],
            ], $messages);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => $allMessages,
                'temperature' => 0.7,
                'max_tokens' => 500,
                'top_p' => 1,
            ]);

            if ($response->failed()) {
                Log::error('Groq API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                throw new \Exception('Failed to get response from AI');
            }

            $data = $response->json();

            return [
                'success' => true,
                'message' => $data['choices'][0]['message']['content'] ?? 'Maaf, tidak ada respon.',
            ];
        } catch (\Exception $e) {
            Log::error('Chat Service Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Maaf, terjadi kesalahan saat memproses pesan Anda. Silakan coba lagi.',
                'error' => $e->getMessage(),
            ];
        }
    }
}