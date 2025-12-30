<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold text-gray-800">Sua Sugestão para Hoje</h1>

        <button wire:click="loadSuggestion" wire:loading.attr="disabled" class="btn-secondary">
            <span wire:loading.remove>Gerar Nova Ideia</span>
            <span wire:loading>Gerando...</span>
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 min-h-[200px]">

        <div wire:loading wire:target="loadSuggestion" class="text-center">
            <p class="text-gray-500">Aguarde, nosso especialista de IA está criando uma ideia incrível para você...</p>
        </div>

        <div wire:loading.remove>
            @if($suggestionContent)
                {{-- A nl2br() preserva as quebras de linha que a IA retorna --}}
                {{-- <p class="text-gray-700 whitespace-pre-wrap">{!! nl2br(e($suggestionContent)) !!}</p> --}}
                <p class="text-gray-700 whitespace-pre-wrap">@markdown($suggestionContent)</p>
                @else
                <p class="text-gray-500">Clique em "Gerar Nova Ideia" para começar!</p>
            @endif
        </div>
    </div>
</div>
