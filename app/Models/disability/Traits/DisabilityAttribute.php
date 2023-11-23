<?php

namespace App\Models\disability\Traits;

trait DisabilityAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            null,
            $this->getEditButtonAttribute('disabilities.edit', 'edit-disability'),
            $this->getDeleteButtonAttribute('disabilities.destroy', 'delete-disability'),
        );
    }
}
