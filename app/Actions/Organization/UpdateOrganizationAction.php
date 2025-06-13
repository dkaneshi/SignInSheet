<?php

declare(strict_types=1);

namespace App\Actions\Organization;

use App\Models\Organization;

final readonly class UpdateOrganizationAction
{
    /**
     * @param  Organization  $organization
     * @param  array<string, mixed>  $data
     * @return bool
     */
    public function handle(Organization $organization, array $data): bool
    {
        $organization = Organization::query()->findOrFail($organization->id);

        return $organization->update($data);
    }

}
