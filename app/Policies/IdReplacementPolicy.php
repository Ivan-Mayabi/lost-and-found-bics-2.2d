<?php

namespace App\Policies;

use App\Models\IdReplacement;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdReplacementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isApprover();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, IdReplacement $idReplacement): bool
    {
        return $user->id === $idReplacement->user_id ||
            $user->hasRole('admin') ||
            $user->hasRole('id_approver');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('student') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IdReplacement $idReplacement): bool
    {
        return $user->hasRole('admin') ||
            $user->hasRole('id_approver') ||
            ($user->id === $idReplacement->user_id && $idReplacement->isPending());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IdReplacement $idReplacement): bool
    {
        return $user->hasRole('admin') ||
            ($user->id === $idReplacement->user_id && $idReplacement->isPending());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IdReplacement $idReplacement): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IdReplacement $idReplacement): bool
    {
        return $user->hasRole('admin');
    }
}
