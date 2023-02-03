<?php

use App\Http\Controllers\action_plan\ActionPlanController;
use App\Http\Controllers\cohort\CohortController;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\donor\DonorController;
use App\Http\Controllers\participant\ParticipantController;
use App\Http\Controllers\programme\ProgrammeController;
use App\Http\Controllers\proposal\ProposalController;
use App\Http\Controllers\region\RegionController;
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

Route::get('/', [CoreController::class, 'index']);
Route::get('home', [CoreController::class, 'index'])->name('home');
Route::get('register', [CoreController::class, 'register'])->name('register');
Route::get('login', [CoreController::class, 'login'])->name('login');
Route::get('error_404', [CoreController::class, 'error_404'])->name('error_404');

Route::resource('user_profiles', UserProfileController::class);

// donors
Route::resource('donors', DonorController::class);

// programmes
Route::resource('programmes', ProgrammeController::class);

// regions
Route::resource('regions', RegionController::class);

// cohorts
Route::resource('cohorts', CohortController::class);

// proposals
Route::resource('proposals', ProposalController::class);
Route::post('proposals/items', [ProposalController::class, 'proposal_items'])->name('proposals.items');

// action plans
Route::resource('action_plans', ActionPlanController::class);
Route::post('action_plans/proposal_items', [ActionPlanController::class, 'proposal_items'])->name('action_plans.proposal_items');

// participants
Route::resource('participants', ParticipantController::class);


if (env('APP_ENV') == 'production') {
    URL::forceScheme('https');
}
