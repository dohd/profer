<?php

namespace App\Models;

trait UserAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            null,
            $this->getEditButtonAttribute('user_profiles.edit', ''),
            $this->getDeleteButtonAttribute('user_profiles.destroy', ''),
        );
    }
}
