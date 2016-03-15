<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Models\invoice;

class invoicePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }*/

    public function create()
    {
        dd("you're here");
        return true;
        //return $user->roles()->where('name', '=', 'main')->exists();
    }
}
