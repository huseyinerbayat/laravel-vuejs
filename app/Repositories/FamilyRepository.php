<?php

namespace App\Repositories;

use App\Models\Family;

class FamilyRepository{

    public function create($user, $family_infos){
        $family_infos['user_id'] = $user->id;
        return Family::create($family_infos)->fresh();
    }

    public function update($user, $family_infos){
        return $user->family ? $user->family->update($family_infos) : false;
    }

}