<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\age_group\AgeGroup;
use App\Models\cohort\Cohort;
use App\Models\disability\Disability;
use App\Models\donor\Donor;
use App\Models\item\NarrativeItem;
use App\Models\item\ParticipantListItem;
use App\Models\narrative_pointer\NarrativePointer;
use App\Models\participant_list\ParticipantList;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    // participant analysis data
    public function participant_analysis_data()
    {
        $q = null;
        if (request('age_group_id') || request('disability_id')) {
            $q = ParticipantListItem::query();

            $q->when(request('age_group_id'), fn($q) => $q->where('age_group_id', request('age_group_id')));
            $q->when(request('disability_id'), fn($q) => $q->where('disability_id', request('disability_id')));

            $q->when(request('donor_id'), function ($q) {
                $q->whereHas('participant_list', function ($q) {
                    $q->whereHas('proposal', fn($q) => $q->where('donor_id', request('donor_id')));
                });
            });
            $q->when(request('programme_id'), function ($q) {
                $q->whereHas('participant_list', fn($q) => $q->where('programme_id', request('programme_id')));
            });
            $q->when(request('region_id'), function ($q) {
                $q->whereHas('participant_list', fn($q) => $q->where('region_id', request('region_id')));
            });
            $q->when(request('cohort_id'), function ($q) {
                $q->whereHas('participant_list', fn($q) => $q->where('cohort_id', request('cohort_id')));
            });
        } else {
            $q = ParticipantList::query();

            $q->when(request('donor_id'), function ($q) {
                $q->whereHas('proposal', fn($q) => $q->where('donor_id', request('donor_id')));
            });
            $q->when(request('programme_id'), fn($q) => $q->where('programme_id', request('programme_id')));
            $q->when(request('region_id'), fn($q) => $q->where('region_id', request('region_id')));
            $q->when(request('cohort_id'), fn($q) => $q->where('cohort_id', request('cohort_id')));
        }

        $q->when(request('start_date') && request('end_date'), function ($q) {
            $q->whereBetween('date', [
                databaseDate(request('start_date')), 
                databaseDate(request('end_date'))
            ]);
        });

        $ps_count = $q->selectRaw('MONTH(date) AS month, SUM(total_count) AS total_count')
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

        return response()->json($ps_count);
    }
}
