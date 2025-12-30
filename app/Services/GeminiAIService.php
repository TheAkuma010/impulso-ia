<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class GeminiAIService
{
    protected string $apiKey;
    protected string $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');

        if (!$this->apiKey) {
            throw new Exception('Gemini API key not found');
        }
    }

    public function sendRequest(string $text): array|string
    {
        $payload = [
            'system_instruction' => [
                'parts'=> [
                    ['text'=> $this->promptInstructions()]
                ],
            ],
            'contents' => [
                [
                    'parts' => [
                        ['text' => $text]
                    ],
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])
            ->timeout(90)
            ->post($this->apiUrl . '?key=' . $this->apiKey, $payload);

        if ($response->failed()) {
            return $response->json() ?? 'Ocorreu um erro desconhecido ao se comunicar com a API do Gemini.';
        }

        return $response->json();
    }
    private function promptInstructions(): string
    {
        return <<<PROMPT
        Você é um especialista em marketing de conteúdo para redes sociais, focado em ajudar microempreendedores brasileiros.
        Sua tarefa é gerar uma ideia de post para o Instagram.

        **Instruções:**
        1. Gere uma ideia de post criativa e prática.
        2. Sugira o formato ideal (Ex.: Reels, Carrossel com 3 imagens, Story Interativo).
        3. inclua uma sugestão de legenda curta e impactante.
        4. Forneça 3 a 5 hashtags relevantes para o público-alvo.
        5. A linguagem deve ser amigável e conectar-se com o público-alvo descrito.

        Entregue a resposta de forma clara e organizada.

        Não faça uma introdução para a resposta, apenas diga a ideia diretamente.
        PROMPT;
    }
}
