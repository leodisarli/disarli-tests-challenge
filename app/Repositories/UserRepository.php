<?php

namespace App\Repositories;

use App\Models\UserModel;

class UserRepository
{
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getUserByEmail($email)
    {
        $user = $this->container->make(UserModel::class);
        return $user->where('email', $email)
            ->first();
    }

    public function saveUser($data)
    {
        try {
            $user = new UserModel;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->save();
        } catch (\Exception $ex) {
            return false;
        }
        return true;
        
    }

    public function getUsersOnline()
    {
        $user = $this->container->make(UserModel::class);
        return $user->where('online', 1)
            ->orderBy('id', 'asc')
            ->take(100)
            ->get();
    }

}