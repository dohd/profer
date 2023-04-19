<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\age_group\AgeGroup;
use App\Models\cohort\Cohort;
use App\Models\disability\Disability;
use App\Models\donor\Donor;
use App\Models\item\NarrativeItem;
use App\Models\item\ParticipantListItem;
use App\Models\narrative\Narrative;
use App\Models\narrative_pointer\NarrativePointer;
use App\Models\participant_list\ParticipantList;
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

    // narrative indicator select options
    public function narrative_options()
    {
        $narratives = Narrative::where('proposal_id', request('proposal_id'))
            ->get(['id', 'tid', 'date'])->map(function($v) {
                $d = explode('-', $v->date);
                $v->code = tidCode('activity_narrative', $v->tid) . "/{$d[1]}";
                return $v;
            });

        return response()->json($narratives);
    }

    // narrative indicator data
    public function narrative_indicator_data(Request $request)
    {
        $data = $request->only(['narrative_id', 'narrative_pointer_id']);

        $narrative_item = NarrativeItem::where($data)->first();

        $programmes = Programme::whereHas('action_plans', function ($q) use($narrative_item) {
            $q->whereHas('proposal', function ($q) use($narrative_item) {
                $q->whereHas('items', function ($q) use($narrative_item) {
                    $q->where('proposal_items.id', $narrative_item->proposal_item_id);
                });
            });
        })->pluck('name')->unique();
        $regions = Region::whereHas('action_plans', function ($q) use($narrative_item) {
            $q->whereHas('proposal', function ($q) use($narrative_item) {
                $q->whereHas('items', function ($q) use($narrative_item) {
                    $q->where('proposal_items.id', $narrative_item->proposal_item_id);
                });
            });
        })->pluck('name')->unique();
        $cohorts = Cohort::whereHas('action_plans', function ($q) use($narrative_item) {
            $q->whereHas('proposal', function ($q) use($narrative_item) {
                $q->whereHas('items', function ($q) use($narrative_item) {
                    $q->where('proposal_items.id', $narrative_item->proposal_item_id);
                });
            });
        })->pluck('name')->unique();

        return response()->json(compact('narrative_item', 'programmes', 'regions', 'cohorts'));
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
        $ps_count = [];
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
                $q->whereHas('participant_list', function ($q) {
                    $q->whereHas('action_plan', function ($q) {
                        $q->where('programme_id', request('programme_id'));
                        
                    });
                });
            });
            $q->when(request('region_id'), function ($q) {
                $q->whereHas('participant_list', function ($q) {
                    $q->where('region_id', request('region_id'));
                });
            });
            $q->when(request('cohort_id'), function ($q) {
                $q->whereHas('participant_list', function ($q) {
                    $q->where('cohorts_id', request('cohort_id'));
                });
            });

            $q->when(request('start_date') && request('end_date'), function ($q) {
                $q->whereBetween('date', [
                    databaseDate(request('start_date')), 
                    databaseDate(request('end_date'))
                ]);
            });
    
            $ps_count = $q->selectRaw('MONTH(date) AS month, COUNT(*) AS total_count')
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get();
        } else {
            $q = ParticipantList::query();

            $q->when(request('donor_id'), function ($q) {
                $q->whereHas('proposal', fn($q) => $q->where('donor_id', request('donor_id')));
            });
            $q->when(request('programme_id'), function ($q) {
                $q->whereHas('action_plan', function ($q) {
                    $q->where('programme_id', request('programme_id'));
                });
            });
            $q->when(request('region_id'), fn($q) => $q->where('region_id', request('region_id')));
            $q->when(request('cohort_id'), fn($q) => $q->where('cohort_id', request('cohort_id')));

            $q->when(request('start_date') && request('end_date'), function ($q) {
                $q->whereBetween('date', [
                    databaseDate(request('start_date')), 
                    databaseDate(request('end_date'))
                ]);
            });
    
            $ps_count = $q->selectRaw('MONTH(date) AS month, SUM(total_count) AS total_count')
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get();
        }

        return response()->json($ps_count);
    }
}
