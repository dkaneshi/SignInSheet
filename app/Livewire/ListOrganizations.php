<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Organization;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

final class ListOrganizations extends Component
{
    use WithPagination;

    /**
     * @return LengthAwarePaginator<int, Organization>
     */
    #[Computed]
    #[On('organization-added')]
    #[On('organization-updated')]
    public function organizations(): LengthAwarePaginator
    {
        return Organization::query()->orderBy('name')->paginate(10);
    }

    public function render(): View|Factory|\Illuminate\View\View
    {
        return view('livewire.list-organizations');
    }
}
