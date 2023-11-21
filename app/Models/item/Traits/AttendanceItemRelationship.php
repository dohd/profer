<?php

namespace App\Models\item\Traits;

use App\Models\age_group\AgeGroup;
use App\Models\attendance\Attendance;
use App\Models\cohort\Cohort;
use App\Models\disability\Disability;
use App\Models\region\Region;

trait AttendanceItemRelationship
{
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function age_group()
    {
        return $this->belongsTo(AgeGroup::class);
    }

    public function disability()
    {
        return $this->belongsTo(Disability::class);
    }
}
