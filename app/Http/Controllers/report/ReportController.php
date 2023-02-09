<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\age_group\AgeGroup;
use App\Models\cohort\Cohort;
use App\Models\disability\Disability;
use App\Models\donor\Donor;
use App\Models\item\NarrativeItem;
use App\Models\narrative_pointer\NarrativePointer;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Indicator narrative page
     */
    public function narrative_indicator()
    {
        // filters
        $proposals = Proposal::get(['id', 'title']);
        $narrative_pointers = NarrativePointer::get(['id', 'value']);
        $programmes = Programme::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);

        return view('reports.narrative_indicator', compact('proposals', 'narrative_pointers', 'programmes', 'regions', 'cohorts'));
    }

    /**
     * Participant analysis page
     */
    public function participant_analysis()
    {
        $donors = Donor::get(['id', 'name']);
        $programmes = Programme::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);
        $disabilities = Disability::get(['id', 'name']);
        $age_groups = AgeGroup::get(['id', 'bracket']);

        return view('reports.participant_analysis', 
            compact('donors', 'programmes', 'regions', 'cohorts', 'disabilities', 'age_groups')
        );
    }

}
