<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): bool|null
    {
        if (provide_all_permission($user)) {
            return true;
        }

        return null;
    }

    public function view() : bool|null {
        return false;
    }
}
