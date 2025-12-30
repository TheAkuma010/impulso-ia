<?php

namespace App\Actions;

use App\Models\Business;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Http;
use App\Services\GeminiAIService;

class GeneratePostSuggestion
{
    protected GeminiAIService $geminiAIService;

    public function __construct(GeminiAIService $geminiAIService)
    {
        $this->geminiAIService = $geminiAIService;
    }

    public function handle(Business $business): Suggestion
    {
        $product = $business->products()->inRandomOrder()->first();
        $audience = $business->targetAudiences()->inRandomOrder()->first();

        if (!$product || !$audience) {
            return Suggestion::create([
                'business_id' => $business->id,
                'content' => 'Por favor, adicione pelo menos um produto e um público-alvo para gerar sugestões personalizadas.',
            ]);
        }

        $prompt = $this->buildPrompt($business, $product, $audience);

        $response = $this->geminiAIService->sendRequest($prompt);

        $conteudoGerado = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'Não foi possível gerar uma sugestão personalizada neste momento, tente novamente mais tarde.';

        return Suggestion::create([
            'business_id' => $business->id,
            'content' => $conteudoGerado,
        ]);
    }

    private function buildPrompt($business, $product, $audience): string
    {
        return <<<PROMPT
        **Contexto da Empresa:**
        - Nome da Empresa: {$business->name}
        - Descrição: {$business->description}
        - Nicho: {$business->niche}

        **Detalhes para o Post de Hoje:**
        - Produto em Foco: {$product->name} (Descrição: {$product->description})
        - Público-Alvo: {$audience->name} (Descrição: {$audience->description})
        PROMPT;
    }
}
