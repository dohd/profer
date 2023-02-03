<?php

namespace App\Models\action_plan\Traits;

use App\Models\item\ActionPlanItem;
use App\Models\proposal\Proposal;
use Illuminate\Support\Facades\DB;

trait ActionPlanRelationship
{
    public function programme()
    {
        return DB::table('programmes')->find($this->programme_id);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function items()
    {
        return $this->hasMany(ActionPlanItem::class);
    }
}
