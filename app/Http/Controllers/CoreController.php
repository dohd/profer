<?php

namespace App\Http\Controllers;

use App\Models\cohort\Cohort;
use App\Models\donor\Donor;
use App\Models\item\ProposalItem;
use App\Models\programme\Programme;
use App\Models\proposal\Proposal;
use App\Models\region\Region;
use Illuminate\Http\Request;

class CoreController extends Controller
{
    // dashboard
    public function index()
    {
        $donor_count = Donor::count();
        $programmes_count = Programme::count();
        $regions_count = Region::count();
        $cohorts_count = Cohort::count();

        $activity_count = ProposalItem::whereHas('participant_lists')->count();
        $activity_proposal_count = Proposal::whereHas('participant_lists')->count();

        $grant_amount = Proposal::where('status', 'approved')->sum('budget');
        $approved_proposal_count = Proposal::where('status', 'approved')->count();
        $proposal_count = Proposal::count();
        
        return view(
            'home', 
            compact(
                'donor_count', 'programmes_count', 'regions_count', 'cohorts_count', 'activity_count', 
                'activity_proposal_count', 'grant_amount', 'approved_proposal_count', 'proposal_count'
            )
        );
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
