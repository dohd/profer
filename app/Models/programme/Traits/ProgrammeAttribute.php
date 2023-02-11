<?php

namespace App\Models\programme\Traits;

trait ProgrammeAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('programmes.show', ''),
            $this->getEditButtonAttribute('programmes.edit', ''),
            $this->getDeleteButtonAttribute('programmes.destroy', ''),
        );
    }
}
