<?php

namespace App\Models;

use App\Models\role\Role;
use App\Models\user_profile\UserProfile;

trait UserRelationship
{
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'rel_id');
    }
}
