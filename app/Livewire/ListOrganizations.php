<?php

namespace App\Livewire;

use App\Models\Organization;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListOrganizations extends Component
{
    use WithPagination;

    #[Computed]
    #[On('organization-added')]
    public function organizations(): LengthAwarePaginator
    {
        return Organization::query()->orderBy('name')->paginate(10);
    }

    public function render()
    {
        return view('livewire.list-organizations');
    }
}
