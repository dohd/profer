<?php

use App\Http\Controllers\action_plan\ActionPlanController;
use App\Http\Controllers\age_group\AgeGroupController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\cohort\CohortController;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\disability\DisabilityController;
use App\Http\Controllers\donor\DonorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\narrative\NarrativeController;
use App\Http\Controllers\participant_list\ParticipantListController;
use App\Http\Controllers\programme\ProgrammeController;
use App\Http\Controllers\proposal\ProposalController;
use App\Http\Controllers\region\RegionController;
use App\Http\Controllers\report\ReportController;
use App\Http\Controllers\user_profile\UserProfileController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [LoginController::class, 'index']);
Route::get('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    // Route::get('error_404', [CoreController::class, 'error_404'])->name('error_404');

    Route::resource('user_profiles', UserProfileController::class);

    /**
     * key indicators
     */
    Route::resource('donors', DonorController::class);
    Route::resource('programmes', ProgrammeController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('cohorts', CohortController::class);
    Route::resource('disabilities', DisabilityController::class);
    Route::resource('age_groups', AgeGroupController::class);

    /**
     * project management
     */
    // proposals
    Route::post('proposals/items', [ProposalController::class, 'proposal_items'])->name('proposals.items');
    Route::post('proposals/datatable', [ProposalController::class, 'datatable'])->name('proposals.datatable');
    Route::resource('proposals', ProposalController::class);

    // action plans
    Route::post('action_plans/cohort/edit', [ActionPlanController::class, 'edit_cohort'])->name('action_plans.edit_cohort');
    Route::post('action_plans/cohort/update', [ActionPlanController::class, 'update_cohort'])->name('action_plans.update_cohort');
    Route::post('action_plans/cohort/store', [ActionPlanController::class, 'store_cohort'])->name('action_plans.store_cohort');
    Route::post('action_plans/cohort/delete', [ActionPlanController::class, 'destroy_cohort'])->name('action_plans.destroy_cohort');

    Route::post('action_plans/activity/edit', [ActionPlanController::class, 'edit_activity'])->name('action_plans.edit_activity');
    Route::post('action_plans/activity/update', [ActionPlanController::class, 'update_activity'])->name('action_plans.update_activity');
    Route::post('action_plans/activity/store', [ActionPlanController::class, 'store_activity'])->name('action_plans.store_activity');
    Route::post('action_plans/activity/delete', [ActionPlanController::class, 'destroy_activity'])->name('action_plans.destroy_activity');
    Route::post('action_plans/proposal_items', [ActionPlanController::class, 'proposal_items'])->name('action_plans.proposal_items');
    Route::resource('action_plans', ActionPlanController::class);

    // participants
    Route::resource('participant_lists', ParticipantListController::class);

    // narratives
    Route::resource('narratives', NarrativeController::class);

    /**
     * Reports
     */
    // narrative indicator
    Route::get('narrative_indicator', [ReportController::class, 'narrative_indicator'])->name('reports.narrative_indicator');
    Route::post('narrative_options', [ReportController::class, 'narrative_options'])->name('reports.narrative_options');
    Route::post('narrative_indicator_data', [ReportController::class, 'narrative_indicator_data'])->name('reports.narrative_indicator_data');

    // participant analysis
    Route::get('participant_analysis', [ReportController::class, 'participant_analysis'])->name('reports.participant_analysis');
    Route::post('participant_analysis_data', [ReportController::class, 'participant_analysis_data'])->name('reports.participant_analysis_data');
});


if (env('APP_ENV') == 'production') {
    URL::forceScheme('https');
}
