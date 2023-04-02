<?php

namespace App\Http\Controllers;

use App\Models\age_group\AgeGroup;
use App\Models\cohort\Cohort;
use App\Models\donor\Donor;
use App\Models\item\ParticipantListItem;
use App\Models\item\ProposalItem;
use App\Models\participant_list\ParticipantList;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\Region;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // indicators
        $donor_count = Donor::count();
        $programmes_count = Programme::count();
        $regions_count = Region::count();
        $cohorts_count = Cohort::count();

        // activities
        $activity_done_count = ProposalItem::whereHas('participant_lists')->count();
        $project_done_count = Proposal::whereHas('participant_lists')->count();

        // projects
        $project_budget = Proposal::where('status', 'approved')->sum('budget');
        $project_count = Proposal::where('status', 'approved')->count();
        $proposal_count = Proposal::count();

        // monthly participant chart
        $sql = 'MONTH(date) as month, SUM(male_count) as male_count, SUM(female_count) as female_count';
        $monthly_pts = ParticipantList::selectRaw($sql)->groupBy('date')->get();

        // donor activity distribution chart
        $sql = 'proposal_id, COUNT(*) as count';
        $donor_activity_dist = ParticipantList::selectRaw($sql)->groupBy('proposal_id')->get();
        $donors_dist = Donor::whereHas('proposals', fn($q) => $q->whereIn('proposals.id', $donor_activity_dist->pluck('proposal_id')->toArray()))
            ->pluck('name'); 

        // participant age distribution chart
        $sql = 'age_group_id, COUNT(*) as count';
        $age_group_dist = ParticipantListItem::selectRaw($sql)->groupBy('age_group_id')->get();
        $age_dist = AgeGroup::whereIn('id', $age_group_dist->pluck('age_group_id')->toArray())
            ->pluck('bracket'); 
            
        return view('home', compact(
            'donor_count', 'programmes_count', 'regions_count', 'cohorts_count', 
            'activity_done_count', 'project_done_count', 
            'project_budget', 'project_count', 'proposal_count',
            'monthly_pts', 
            'donor_activity_dist', 'donors_dist',
            'age_group_dist', 'age_dist'
        ));
    }

    // register
    public function register()
    {
        return view('register');
    }

    // login
    public function login()
    {
        return view('login');
    }

    // error 404
    public function error_404()
    {
        return view('error_404');
    }
}
