<?php

namespace App\Models\document_import\Traits;

trait DocumentImportAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('document_imports.show', ''),
            $this->getEditButtonAttribute('document_imports.edit', ''),
            $this->getDeleteButtonAttribute('document_imports.destroy', ''),
        );
    }
}
