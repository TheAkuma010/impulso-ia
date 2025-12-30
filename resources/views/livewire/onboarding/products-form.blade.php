<div class="max-w-2xl max-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Produtos</h1>
    </div>

    <form wire:submit.prevent="save">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="space-y-6">
                <div>
                    <label for="name" class="form-label">Nome do Produto</label>
                    <input type="text" id="name" wire:model="name" class="form-control" />
                    @error('name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="description" class="form-label">Descrição do Produto</label>
                    <textarea id="description" wire:model="description" class="form-control"></textarea>
                    @error('description')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-6 flex">
            <button type="submit" class="btn-primary">
                Adicionar Produto
            </button>
        </div>
    </form>

    @foreach ($products as $product)
        <div class="mt-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="justify-between items-center mb">
                    <p class="text-2xl font-semibold text-gray-800">{{ $product->name }}</p>
                    <p class="form-label text-gray-700">Descrição: {{ $product->description }}</p>
                    </br>
                    <div class="flex items-center space-x-2">
                        <button wire:click="editProduct({{ $product->id }})" class="btn-primary">Editar</button>
                        <button wire:click="deleteProduct({{ $product->id }})" class="btn-delete">Excluir</button>
                    </div>
            </div>
        </div>
    @endforeach

    @if(session()->has('message'))
        <div class="mt-4 text-green-600 p-4 bg-green-100 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</div>
