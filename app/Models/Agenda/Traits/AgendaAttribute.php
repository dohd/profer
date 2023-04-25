<?php

namespace App\Models\agenda\Traits;

trait AgendaAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('agenda.show', ''),
            $this->getEditButtonAttribute('agenda.edit', ''),
            $this->getDeleteButtonAttribute('agenda.destroy', ''),
        );
    }
}
