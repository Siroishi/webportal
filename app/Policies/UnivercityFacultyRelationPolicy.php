<?php

namespace App\Policies;

use App\Models\UnivercityFacultyRelation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UnivercityFacultyRelationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UnivercityFacultyRelation $univercityFacultyRelation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UnivercityFacultyRelation $univercityFacultyRelation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UnivercityFacultyRelation $univercityFacultyRelation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, UnivercityFacultyRelation $univercityFacultyRelation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UnivercityFacultyRelation $univercityFacultyRelation): bool
    {
        return false;
    }
}
