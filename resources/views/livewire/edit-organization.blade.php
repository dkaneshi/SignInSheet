<div>
    <form wire:submit="editOrganization({{ $organization->id }})">
        <flux:input label="Name" placeholder="Organization Name" value="{{ $name }}" wire:model="name"/>
        <div class="flex mt-4">
            <flux:spacer/>

            <flux:button type="submit" variant="primary">Save changes</flux:button>
        </div>
    </form>
</div>
