<?php

namespace App\Models\cohort\Traits;

trait CohortAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            null,
            $this->getEditButtonAttribute('cohorts.edit', ''),
            $this->getDeleteButtonAttribute('cohorts.destroy', ''),
        );
    }
}
