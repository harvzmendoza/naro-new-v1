<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\IssuanceType;
use Illuminate\Auth\Access\HandlesAuthorization;

class IssuanceTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:IssuanceType');
    }

    public function view(AuthUser $authUser, IssuanceType $issuanceType): bool
    {
        return $authUser->can('View:IssuanceType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:IssuanceType');
    }

    public function update(AuthUser $authUser, IssuanceType $issuanceType): bool
    {
        return $authUser->can('Update:IssuanceType');
    }

    public function delete(AuthUser $authUser, IssuanceType $issuanceType): bool
    {
        return $authUser->can('Delete:IssuanceType');
    }

    public function restore(AuthUser $authUser, IssuanceType $issuanceType): bool
    {
        return $authUser->can('Restore:IssuanceType');
    }

    public function forceDelete(AuthUser $authUser, IssuanceType $issuanceType): bool
    {
        return $authUser->can('ForceDelete:IssuanceType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:IssuanceType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:IssuanceType');
    }

    public function replicate(AuthUser $authUser, IssuanceType $issuanceType): bool
    {
        return $authUser->can('Replicate:IssuanceType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:IssuanceType');
    }

}