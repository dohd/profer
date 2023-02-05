<?php

namespace App\Models\item\Traits;

use App\Models\narrative_pointer\NarrativePointer;

trait NarrativeItemRelationship
{
    public function narrative_pointer()
    {
        return $this->belongsTo(NarrativePointer::class);
    }
}
