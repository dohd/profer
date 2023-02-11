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
            $this->getViewButtonAttribute('disabilities.show', ''),
            $this->getEditButtonAttribute('disabilities.edit', ''),
            $this->getDeleteButtonAttribute('disabilities.destroy', ''),
        );
    }
}
