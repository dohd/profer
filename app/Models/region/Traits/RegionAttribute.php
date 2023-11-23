<?php

namespace App\Models\region\Traits;

trait RegionAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            null,
            $this->getEditButtonAttribute('regions.edit', ''),
            $this->getDeleteButtonAttribute('regions.destroy', ''),
        );
    }
}
