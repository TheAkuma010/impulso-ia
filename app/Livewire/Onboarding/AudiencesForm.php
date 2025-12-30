<?php

namespace App\Livewire\Onboarding;

use App\Models\Forms;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AudiencesForm extends Component
{
    public function render()
    {
        return view('livewire.onboarding.audiences-form');
    }
}
