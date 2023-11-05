<?php

namespace App\Models\budget\Traits;

trait BudgetAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('budgets.show', ''), 
            $this->getEditButtonAttribute('budgets.edit', ''),
            $this->getDeleteButtonAttribute('budgets.destroy', ''),
        );
    }
}
