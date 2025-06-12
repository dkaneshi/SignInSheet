<?php

namespace App\Livewire;

use App\Actions\Organization\CreateOrganizationAction;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddOrganization extends Component
{
    #[Validate('required|string|min:3|max:255|unique:organizations,name')]
    public string $name = '';

    public function addOrganization(CreateOrganizationAction $action): void
    {
        $action->handle($this->validate());

        self::resetForm();

        $this->dispatch('organization-added');
    }

    public function resetForm(): void
    {
        $this->reset('name');
    }

    public function render()
    {
        return view('livewire.add-organization');
    }
}
