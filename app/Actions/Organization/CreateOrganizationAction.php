<?php

declare(strict_types=1);

namespace App\Actions\Organization;

use App\Models\Organization;

final readonly class CreateOrganizationAction
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function handle(array $data): Organization
    {
        return Organization::query()->create($data);
    }
}
