<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\age_group\AgeGroup;
use App\Models\agenda\Agenda;
use App\Models\cohort\Cohort;
use App\Models\disability\Disability;
use App\Models\donor\Donor;
use App\Models\item\ParticipantListItem;
use App\Models\item\ProposalItem;
use App\Models\narrative_pointer\NarrativePointer;
use App\Models\participant_list\ParticipantList;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Beneficiary List Report 
     */
    public function beneficiary_list()
    {
        return view('reports.beneficiary_list');
    }

    /**
     * Monthly Meetings Report 
     */
    public function monthly_meetings()
    {
        return view('reports.monthly_meetings');
    }

    /**
     * Narrative Report Page
     */
    public function narrative_report()
    {   
        // filters
        $proposals = Proposal::get(['id', 'title']);
        $narrative_pointers = NarrativePointer::get(['id', 'value']);
        $programmes = Programme::get(['id', 'name']);
        $regions = Region::get(['id', 'name']);
        $cohorts = Cohort::get(['id', 'name']);

        $proposal_items = ProposalItem::whereHas('agenda', fn($q) => $q->whereHas('narrative'))->get();
            
        return view('reports.narrative_report', compact('proposal_items', 'proposals', 'narrative_pointers', 'programmes', 'regions', 'cohorts'));
    }

    /**
     * Narrative Report Data
     */
    public function narrative_data(Request $request)
    {
        $agenda = Agenda::where('proposal_item_id', $request->proposal_item_id)->get();

        return view('reports.partial.narrative_report_table', compact('agenda'));
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
    
            $ps_count = $q->selectRaw('MONTH(date) AS month, gender, COUNT(*) AS count')
                ->groupBy('month', 'gender')
                ->orderBy('month', 'ASC')
                ->get()
                ->toArray();

            $ps_count_mod = [];
            foreach ($ps_count as $item) {
                if (in_array("{$item['month']}_", $ps_count_mod)) {
                    if ($item['gender'] == 'male') $ps_count_mod["{$item['month']}_"]['male_count'] += $item['count'];
                    else $ps_count_mod["{$item['month']}_"]['female_count'] += $item['count'];
                    $ps_count_mod["{$item['month']}_"]['total_count'] += $item['count'];
                } else {
                    $ps_count_mod["{$item['month']}_"] = [
                        'month' => $item['month'],
                        'male_count' => $item['gender'] == 'male'? $item['count'] : 0,
                        'female_count' => $item['gender'] == 'female'? $item['count'] : 0,
                        'total_count' => $item['count'],
                    ];
                }
            }
            $ps_count = array_values($ps_count_mod);
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
            
            $q_str = 'MONTH(date) AS month, SUM(male_count) AS male_count, SUM(female_count) AS female_count, SUM(total_count) AS total_count';
            $ps_count = $q->selectRaw($q_str)
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get();
        }

        return response()->json($ps_count);
    }
}
