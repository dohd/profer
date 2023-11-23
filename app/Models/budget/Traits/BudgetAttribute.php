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
            $this->getViewButtonAttribute('budgets.show', 'view-budgeting'), 
            $this->getEditButtonAttribute('budgets.edit', 'edit-budgeting'),
            $this->getDeleteButtonAttribute('budgets.destroy', 'delete-budgeting'),
        );
    }
}
