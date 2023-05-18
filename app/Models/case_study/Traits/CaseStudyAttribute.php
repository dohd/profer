<?php

namespace App\Models\case_study\Traits;

trait CaseStudyAttribute
{
    /**
     * Action Button Attribute to show in grid
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getButtonWrapperAttribute(
            $this->getViewButtonAttribute('case_studies.show', ''),
            $this->getEditButtonAttribute('case_studies.edit', ''),
            $this->getDeleteButtonAttribute('case_studies.destroy', ''),
        );
    }
}
