<?php

namespace App\Business;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserBusiness
{
    public function __construct(
        Request $request,
        UserRepository $userRepository
    ) {
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function validateUser($email)
    {
        $user = $this->userRepository->getUserByEmail($email);
        if (empty($user)) {
            throw \Exception('user not found', 404);    
        }
        return $user; 
    }

    public function saveUser($data)
    {
        $data = $this->request->all();
        $result = $this->userRepository->saveUser($data);
        return $result;
    }

    public function getAllUsersOnline()
    {
        $userList = $this->userRepository->getUsersOnline();
        if (empty($userList)) {
            return null;
        }
        return $userList;
    }
}