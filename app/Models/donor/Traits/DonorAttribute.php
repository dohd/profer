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
            $this->getViewButtonAttribute('donors.show', ''),
            $this->getEditButtonAttribute('donors.edit', ''),
            $this->getDeleteButtonAttribute('donors.destroy', ''),
        );
    }
}
