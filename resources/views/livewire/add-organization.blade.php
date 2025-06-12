<div>
    <flux:card class="spacy-y-4">
        <div class="mb-4">
            <flux:heading size="lg">Add Organization</flux:heading>
        </div>
        <div>
            <form wire:submit="addOrganization" class="space-y-4">
                <div class="mb-4">
                    <flux:field>
                        <flux:label>Name</flux:label>
                        <flux:input wire:model="name"/>
                        <flux:error name="name"/>
                    </flux:field>
                </div>

                <div class="mb-4">
                    <flux:button type="submit" :loading="true">Add User</flux:button>
                    <flux:button type="button" wire:click="resetForm">Reset</flux:button>
                </div>
            </form>
        </div>
    </flux:card>
</div>
