<?php

namespace App\Models\proposal\Traits;

use App\Models\donor\Donor;
use App\Models\item\ProposalItem;
use App\Models\log_frame\LogFrame;
use App\Models\participant_list\ParticipantList;
use App\Models\region\Region;

trait ProposalRelationship
{
    public function log_frames()
    {
        return $this->hasMany(LogFrame::class);
    }

    public function participant_lists()
    {
        return $this->hasMany(ParticipantList::class);
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function items()
    {
        return $this->hasMany(ProposalItem::class)->orderBy('row_index', 'asc');
    }

    public function objectives()
    {
        return $this->hasMany(ProposalItem::class)->where('is_obj', 1)->orderBy('row_index', 'asc');
    }
    
    public function activites()
    {
        return $this->hasMany(ProposalItem::class)->where('is_obj', 0)->orderBy('row_index', 'asc');
    }
}
