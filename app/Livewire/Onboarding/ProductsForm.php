<?php

namespace App\Livewire\Onboarding;

use App\Models\Forms;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProductsForm extends Component
{
    public ?Product $product;
    public string $name = '';
    public string $description = '';

    public function mount()
    {
        $this->products = Auth::user()->business->products;

        // if ($this->products) {
        //     $this->name = $this->products->name;
        //     $this->description = $this->business->products->description;
        // }
    }

    public function save()
    {
        $user = Auth::user();

        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $user->business->products()->updateOrCreate(
            $validatedData
        );

        session()->flash('success', 'Dados do produto salvos com sucesso!');

        return redirect()->route('products');
    }

    public function render()
    {
        $products = Auth::user()->business->products()
            ->get();

        return view('livewire.onboarding.products-form', ['products' => $products]);
    }
}
