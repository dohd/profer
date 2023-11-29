<?php

namespace App\Models\prefix\Traits;

trait PrefixAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            null,
            $this->getEditButtonAttribute('programmes.edit', 'edit-programme'),
            null
        );
    }
}
