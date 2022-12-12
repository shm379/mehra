<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
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

    public function create (User $user) {
        return true;
    }

    public function edit (User $user, UserAddress $userAddress) {
        return $user->id == $userAddress->user_id;
    }

    public function update (User $user, UserAddress $userAddress) {
        return $user->id == $userAddress->user_id;
    }

    public function delete (User $user, UserAddress $userAddress) {
        return $user->id == $userAddress->user_id;
    }
    public function view (User $user, UserAddress $userAddress) {

        return $user->id == $userAddress->user_id;
    }
}
