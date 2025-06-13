<div>
    <flux:card class="mb-4">
        <div>
            <flux:heading size="lg">Organizations</flux:heading>
        </div>
        <div>
            <flux:table :paginate="$this->organizations">
                <flux:table.columns>
                    <flux:table.column>Name</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @foreach ($this->organizations as $organization)
                        <flux:table.row :key="$organization->id">
                            <flux:table.cell>{{ $organization->name }}</flux:table-cell>
                            <flux:table.cell>
                                <div wire:key="edit-org-{{$organization->id}}">
                                    <flux:modal.trigger name="edit-organization-{{ $organization->id }}">
                                        <flux:button>Edit</flux:button>
                                    </flux:modal.trigger>
                                    <flux:modal name="edit-organization-{{ $organization->id }}"
                                                class="md:w-96"
                                                :dismissable="false">
                                        <div class="space-y-6">
                                            <div>
                                                <flux:heading size="lg">Update Organization</flux:heading>
                                            </div>
                                            <livewire:edit-organization :organization="$organization"
                                                                        :wire:key="'edit-org-'.$organization->id"/>
                                        </div>
                                    </flux:modal>
                                </div>
                            </flux:table-cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        </div>
    </flux:card>
</div>
