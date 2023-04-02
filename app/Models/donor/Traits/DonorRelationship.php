<?php

namespace App\Models\donor\Traits;

use App\Models\proposal\Proposal;

trait DonorRelationship
{
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
