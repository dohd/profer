<?php

namespace App\Models\donor\Traits;

trait DonorAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            null,
            $this->getEditButtonAttribute('donors.edit', 'edit-donor'),
            $this->getDeleteButtonAttribute('donors.destroy', 'delete-donor'),
        );
    }
}
