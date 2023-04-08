<?php

namespace App\Models\role\Traits;

trait RoleAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('roles.show', ''),
            $this->getEditButtonAttribute('roles.edit', ''),
            $this->getDeleteButtonAttribute('roles.destroy', ''),
        );
    }
}
