<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface 
{
    public function createUser($data)
    {
        return User::create($data);
    }

    
    
}
