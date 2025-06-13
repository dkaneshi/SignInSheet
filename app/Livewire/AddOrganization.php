<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\Organization\CreateOrganizationAction;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class AddOrganization extends Component
{
    #[Validate('required|string|min:3|max:255|unique:organizations,name')]
    public string $name = '';

    public function addOrganization(CreateOrganizationAction $action): void
    {
        /** @var array<string, mixed> $validated */
        $validated = $this->validate();
        $action->handle($validated);

        self::resetForm();

        $this->dispatch('organization-added');

        Flux::toast('The organization has been added.', variant: 'success');
    }

    public function resetForm(): void
    {
        $this->reset('name');
    }

    public function render(): View
    {
        return view('livewire.add-organization');
    }
}
