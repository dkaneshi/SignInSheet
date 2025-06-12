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
                                    <livewire:edit-organization :organization="$organization"
                                                                :wire:key="'edit-org-'.$organization->id"/>
                                </div>
                            </flux:table-cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
        </div>
    </flux:card>
</div>
