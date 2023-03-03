<?php

namespace App\Models\log_frame\Traits;

use App\Models\proposal\Proposal;

trait LogFrameRelationship
{
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
