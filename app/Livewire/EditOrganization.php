<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\Organization\UpdateOrganizationAction;
use App\Models\Organization;
use Flux\Flux;
use Livewire\Attributes\Reactive;
use Livewire\Component;

final class EditOrganization extends Component
{
    #[Reactive]
    public Organization $organization;

    public string $name = '';

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:organizations,name,'.$this->organization->id,
            ],
        ];
    }

    public function mount(Organization $organization): void
    {
        $this->name = $organization->name;
    }

    public function editOrganization(UpdateOrganizationAction $action): void
    {
        $organization = Organization::query()->findOrFail($this->organization->id);

        /** @var array<string, string> $validated */
        $validated = $this->validate();

        $action->handle($organization, $validated);

        $this->dispatch('organization-updated');

        // Close the modal
        /** @phpstan-ignore-next-line */
        $this->modal('edit-organization-'.$organization->id)->close();

        Flux::toast('The organization has been updated.', variant: 'success');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.edit-organization');
    }
}
