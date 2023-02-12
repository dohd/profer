<?php

namespace App\Models\age_group\Traits;

trait AgeGroupAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('age_groups.show', ''),
            $this->getEditButtonAttribute('age_groups.edit', ''),
            $this->getDeleteButtonAttribute('age_groups.destroy', ''),
        );
    }
}
