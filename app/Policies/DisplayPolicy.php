<?php

namespace App\Policies;

use App\Models\Display;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisplayPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any displays.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the display.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Display  $display
     * @return bool
     */
    public function view(User $user, Display $display): bool
    {
        return $user->id === $display->user_id;
    }

    /**
     * Determine whether the user can create displays.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the display.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Display  $display
     * @return bool
     */
    public function update(User $user, Display $display): bool
    {
        return $user->id === $display->user_id;
    }

    /**
     * Determine whether the user can delete the display.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Display  $display
     * @return bool
     */
    public function delete(User $user, Display $display): bool
    {
        return $user->id === $display->user_id;
    }
}
