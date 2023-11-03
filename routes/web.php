<?php

use App\Http\Controllers\action_plan\ActionPlanController;
use App\Http\Controllers\age_group\AgeGroupController;
use App\Http\Controllers\agenda\AgendaController;
use App\Http\Controllers\case_study\CaseStudyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\cohort\CohortController;
use App\Http\Controllers\disability\DisabilityController;
use App\Http\Controllers\file_import\FileImportController;
use App\Http\Controllers\donor\DonorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\log_frame\LogFrameController;
use App\Http\Controllers\narrative\NarrativeController;
use App\Http\Controllers\participant_list\ParticipantListController;
use App\Http\Controllers\pdf\PdfController;
use App\Http\Controllers\programme\ProgrammeController;
use App\Http\Controllers\proposal\ProposalController;
use App\Http\Controllers\region\RegionController;
use App\Http\Controllers\report\ReportController;
use App\Http\Controllers\role\RoleController;
use App\Http\Controllers\user_profile\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

/**
 * Authentication
 */
Auth::routes();
Route::get('/', [LoginController::class, 'index']);
Route::get('logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function() {
    /**
     * Dashboard
     */
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('event_calendar', [HomeController::class, 'event_calendar'])->name('event_calendar');

    /**
     * User Profiles
     */
    Route::get('user_profiles/active_profile', [UserProfileController::class, 'active_profile'])->name('user_profiles.active_profile');
    Route::resource('user_profiles', UserProfileController::class);

    /**
     * Roles
     */
    Route::resource('roles', RoleController::class);

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
     * Proposals
     */
    Route::post('proposals/items', [ProposalController::class, 'proposal_items'])->name('proposals.items');
    Route::post('proposals/datatable', [ProposalController::class, 'datatable'])->name('proposals.datatable');
    Route::resource('proposals', ProposalController::class);

    /**
     * Log Frames
     */
    Route::post('log_frames/datatable', [LogFrameController::class, 'datatable'])->name('log_frames.datatable');
    Route::resource('log_frames', LogFrameController::class);

    /**
     * Action Plans
     */
    Route::post('action_plans/cohort/edit', [ActionPlanController::class, 'edit_cohort'])->name('action_plans.edit_cohort');
    Route::post('action_plans/cohort/update', [ActionPlanController::class, 'update_cohort'])->name('action_plans.update_cohort');
    Route::post('action_plans/cohort/store', [ActionPlanController::class, 'store_cohort'])->name('action_plans.store_cohort');
    Route::post('action_plans/cohort/delete', [ActionPlanController::class, 'destroy_cohort'])->name('action_plans.destroy_cohort');

    Route::post('action_plans/activity/edit', [ActionPlanController::class, 'edit_activity'])->name('action_plans.edit_activity');
    Route::post('action_plans/activity/update', [ActionPlanController::class, 'update_activity'])->name('action_plans.update_activity');
    Route::post('action_plans/activity/store', [ActionPlanController::class, 'store_activity'])->name('action_plans.store_activity');
    Route::post('action_plans/activity/delete', [ActionPlanController::class, 'destroy_activity'])->name('action_plans.destroy_activity');
    Route::post('action_plans/proposal_items', [ActionPlanController::class, 'proposal_items'])->name('action_plans.proposal_items');
    Route::post('action_plans/select_activity_items', [ActionPlanController::class, 'select_activity_items'])->name('action_plans.select_activity_items');
    Route::post('action_plans/select_items', [ActionPlanController::class, 'select_items'])->name('action_plans.select_items');
    Route::post('action_plans/datatable', [ActionPlanController::class, 'datatable'])->name('action_plans.datatable');
    Route::resource('action_plans', ActionPlanController::class);

    /**
     * Agenda
     */
    Route::resource('agenda', AgendaController::class);

    /**
     * Participant Lists
     */
    Route::resource('participant_lists', ParticipantListController::class);

    /**
     * Activity Narratives
     */
    Route::post('narratives/narrative_table', [NarrativeController::class, 'narrative_table'])->name('narratives.table');
    Route::resource('narratives', NarrativeController::class);

    /**
     * Case Studies
     */
    Route::resource('case_studies', CaseStudyController::class);

    /**
     * File Imports
     */
    Route::post('file_imports/datatable', [FileImportController::class, 'datatable'])->name('file_imports.datatable');
    Route::resource('file_imports', FileImportController::class);


    /**
     * Reports
     */
    Route::get('reports/monthly_meetings', [ReportController::class, 'monthly_meetings'])->name('reports.monthly_meetings');
    Route::get('reports/narrative_report', [ReportController::class, 'narrative_report'])->name('reports.narrative_report');
    Route::get('reports/participant_analysis', [ReportController::class, 'participant_analysis'])->name('reports.participant_analysis');
    
    Route::post('reports/narrative_data', [ReportController::class, 'narrative_data'])->name('reports.narrative_data');
    Route::post('reports/participant_analysis_data', [ReportController::class, 'participant_analysis_data'])->name('reports.participant_analysis_data');

    /**
     * PDFs
     */
    Route::get('pdfs/agenda/{agenda}/{token}', [PdfController::class, 'print_agenda'])->name('pdfs.print_agenda');
});


if (env('APP_ENV') == 'production') {
    URL::forceScheme('https');
}
