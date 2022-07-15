<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository{

    public function getUserById($id){
        return User::findOrFail($id);
    }

    public function register($user_infos){
        $user_infos['password'] = bcrypt($user_infos["password"]);
        return User::create($user_infos)->fresh();
    }
}