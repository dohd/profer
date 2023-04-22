<?php

namespace App\Http\Controllers;

use App\Models\action_plan\ActionPlanActivity;
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
        $sql = 'MONTH(date) as month, SUM(male_count) as male_count, SUM(female_count) as female_count, SUM(total_count) as total_count';
        $monthly_pts = ParticipantList::selectRaw($sql)->groupBy('date')->get();

        // donor activity distribution chart
        $sql = 'proposal_id, COUNT(*) as count';
        $donor_activity_dist = ParticipantList::selectRaw($sql)->groupBy('proposal_id')->get();
        $donors_dist = Donor::whereHas('proposals', fn($q) => $q->whereIn('proposals.id', $donor_activity_dist->pluck('proposal_id')->toArray()))
            ->pluck('name'); 

        // participant age distribution chart
        $sql = 'age_group_id, Count(*) as count';
        $age_group_dist = ParticipantListItem::selectRaw($sql)->groupBy('age_group_id')->get();
        $age_dist = AgeGroup::whereIn('id', $age_group_dist->pluck('age_group_id')->toArray())
            ->pluck('bracket'); 

        // participant cohort distribution chart
        $sql = 'cohort_id, SUM(total_count) as count';
        $ps_cohort_dist = ParticipantList::selectRaw($sql)->groupBy('cohort_id')->get();
        $cohort_dist = Cohort::whereIn('id', $ps_cohort_dist->pluck('cohort_id')->toArray())
            ->pluck('name'); 

        // region participant chart
        $sql = 'region_id, SUM(male_count) as male_count, SUM(female_count) as female_count, SUM(total_count) as total_count';
        $region_pts = ParticipantList::selectRaw($sql)->groupBy('region_id')->get();
        $region_dist = Region::whereIn('id', $region_pts->pluck('region_id')->toArray())
            ->pluck('name'); 
        
        return view('home', compact(
            'donor_count', 'programmes_count', 'regions_count', 'cohorts_count', 
            'activity_done_count', 'project_done_count', 
            'project_budget', 'project_count', 'proposal_count',
            'monthly_pts', 
            'donor_activity_dist', 'donors_dist',
            'age_group_dist', 'age_dist',
            'ps_cohort_dist', 'cohort_dist',
            'region_pts', 'region_dist',
        ));
    }

    public function event_calendar()
    {
        $events = ActionPlanActivity::with('activity')->get();
        
        return view('layouts.event_calendar', compact('events'));
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function error_404()
    {
        return view('error_404');
    }
}
