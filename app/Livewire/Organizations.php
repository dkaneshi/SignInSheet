<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

final class Organizations extends Component
{
    public function render(): \Illuminate\View\View
    {
        return view('livewire.organizations');
    }
}
