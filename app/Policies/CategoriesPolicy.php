<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\Categories;
use Illuminate\Auth\Access\Response;

class CategoriesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Helper::checkUserPermission('categories.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Categories $categories): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Helper::checkUserPermission('categories.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return Helper::checkUserPermission('categories.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return Helper::checkUserPermission('categories.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Categories $categories): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Categories $categories): bool
    {
        //
    }
}
