<?php

namespace App\Models\action_plan\Traits;

trait ActionPlanAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('action_plans.show', ''),
            $this->getEditButtonAttribute('action_plans.edit', ''),
            $this->getDeleteButtonAttribute('action_plans.destroy', ''),
        );
    }

    /**
     * Next Transaction Id
     */
    public function getNextTidAttribute()
    {
        return $this->where('ins', 1)->max('tid')+1;
    }
}
