<?php

namespace App\Models\deadline\Traits;

use App\Models\action_plan\ActionPlan;
use App\Models\agenda\Agenda;

trait DeadlineRelationship
{
    public function action_plans()
    {
        return $this->hasMany(ActionPlan::class);
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }
}
