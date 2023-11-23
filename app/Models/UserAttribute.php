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
            $this->getEditButtonAttribute('user_profiles.edit', 'edit-user'),
            $this->getDeleteButtonAttribute('user_profiles.destroy', 'delete-user'),
        );
    }
}
