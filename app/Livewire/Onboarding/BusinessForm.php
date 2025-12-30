<?php

namespace App\Livewire\Onboarding;

use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class BusinessForm extends Component
{
    public ?Business $business;
    public string $name = '';
    public string $description = '';
    public string $niche = '';

    public function mount()
    {
        $this->business = Auth::user()->business;

        if ($this->business) {
            $this->name = $this->business->name;
            $this->description = $this->business->description;
            $this->niche = $this->business->niche;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'niche' => 'nullable|string|max:255',
        ]);

        Auth::user()->businesses()->updateOrCreate(
            ['user_id' => Auth::id()],
            $validatedData
        );

        session()->flash('success', 'Dados da empresa salvos com sucesso!');

        // return redirect()->route('onboarding.products');
    }

    public function render()
    {
        return view('livewire.onboarding.business-form');
    }
}
