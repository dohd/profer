<?php

namespace App\Models\log_frame\Traits;

trait LogFrameAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('log_frames.show', ''),
            $this->getEditButtonAttribute('log_frames.edit', ''),
            $this->getDeleteButtonAttribute('log_frames.destroy', ''),
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
