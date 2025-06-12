<div>
    <flux:modal.trigger name="edit-organization-{{ $organization->id }}">
        <flux:button>Edit</flux:button>
    </flux:modal.trigger>
    <flux:modal name="edit-organization-{{ $organization->id }}" class="md:w-96" :dismissable="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Update Organization</flux:heading>
            </div>
            <form wire:submit="editOrganization">
                <flux:input label="Name" placeholder="Organization Name" value="{{ $name }}" wire:model="name"/>
                <div class="flex mt-4">
                    <flux:spacer/>

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
