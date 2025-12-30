<?php

namespace App\Livewire;

use App\Actions\GeneratePostSuggestion;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public ?string $suggestionContent = null;
    public bool $isLoading = false;

    public function mount()
    {
        $this->loadSuggestion();
    }

    public function loadSuggestion()
    {
        $business = Auth::user()->business;

        if (!$business) {
            return redirect()->route('onboarding.business');
        }

        $suggestion = $business->suggestions()
            ->whereDate('created_at', today())
            ->first();

        if ($suggestion) {
            $this->suggestionContent = $suggestion->content;
        } else {
            $this->generateNewSuggestion();
        }
    }

    public function generateNewSuggestion()
    {
        $this->isLoading = true;
        $this->suggestionContent = null;

        $business = Auth::user()->business;

        $action = app(GeneratePostSuggestion::class);
        $newSuggestion = $action->handle($business);

        $this->suggestionContent = $newSuggestion->content;
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
