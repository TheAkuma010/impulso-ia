<div>
    <form wire:submit.prevent="save">
        <div class="space-y-4">
            <div>
                <label for="name">Nome da empresa</label>
                <input type="text" id="name"wire:model="name" class="form-input" />
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description">Descrição do negócio (O que você faz?)</label>
                <textarea id="description" wire:model="description" class="form-textarea"></textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="niche">Nicho de Mercado (Ex: Confeitaria, moda infantil)</label>
                <input type="text" id="niche" wire:model="niche" class="form-input" />
                @error('niche') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="btn-primary">Salvar e Continuar</button>
        </div>
    </form>

    @if(session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>
