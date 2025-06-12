<?php

namespace App\Livewire;

use App\Models\Organization;
use Flux\Flux;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditOrganization extends Component
{
    #[Reactive]
    public Organization $organization;

    #[Validate('required|string|min:3|max:255|unique:organizations,name')]
    public string $name = '';

    public function mount(Organization $organization): void
    {
        $this->name = $organization->name;
    }

    public function editOrganization(): void
    {
        $organization = Organization::query()->findOrFail($this->organization->id);

        $validated = $this->validate();

        $organization->update($validated);

        $this->dispatch('organization-updated');

//        Flux::modals()->close();
        $this->modal('edit-organization-'.$organization->id)->close();
    }

    public function render()
    {
        return view('livewire.edit-organization');
    }
}
