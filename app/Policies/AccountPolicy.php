<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    protected $admin = '777';
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view($user){
        return strpos($user->role_name->function,'account.review') !== false;
    }

    public function create($user){
        return strpos($user->role_name->function,'account.edit') !== false;
    }

    public function update($user){
        return strpos($user->role_name->function,'account.edit') !== false;
    }

    public function delete($user){
        return strpos($user->role_name->function,'account.delete') !== false;
    }

    public function before($user){
        if(strpos($user->role_name->function,$this->admin) !== false){
            return true;
        }
        return null;
    }
}
