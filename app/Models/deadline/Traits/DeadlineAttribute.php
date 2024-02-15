<?php

namespace App\Models\deadline\Traits;

trait DeadlineAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('deadlines.show', 'view-deadline'),
            $this->getEditButtonAttribute('deadlines.edit', 'edit-deadline'),
            $this->getDeleteButtonAttribute('deadlines.destroy', 'delete-deadline'),
        );
    }

    public function getActiveStatusAttribute()
    {
        return $this->active? 'ACTIVE' : 'INACTIVE';
    }
}
