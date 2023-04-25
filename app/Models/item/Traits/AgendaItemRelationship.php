<?php

namespace App\Models\item\Traits;

use App\Models\agenda\Agenda;

trait AgendaItemRelationship
{
    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}
