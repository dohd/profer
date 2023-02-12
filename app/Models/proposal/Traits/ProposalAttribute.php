<?php

namespace App\Models\proposal\Traits;

trait ProposalAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('proposals.show', ''),
            $this->getEditButtonAttribute('proposals.edit', ''),
            $this->getDeleteButtonAttribute('proposals.destroy', ''),
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
