<?php

namespace App\Models\participant_list\Traits;

trait ParticipantListAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('participant_lists.show', ''),
            $this->getEditButtonAttribute('participant_lists.edit', ''),
            $this->getDeleteButtonAttribute('participant_lists.destroy', ''),
        );
    }

    /**
     * Next Transaction Id
     */
    public function getNextTidAttribute()
    {
        return $this->where('ins', 1)->max('tid')+1;
    }
}
