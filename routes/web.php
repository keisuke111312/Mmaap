<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ManualPaymentController;
use App\Http\Controllers\OfficialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminTaskController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberTaskController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ResourceController;

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


// Route::get('/home', [HomeController::class, 'index'])->name('admin.dashboard');

// Route::get('/index', [HomeController::class, 'home'])->name('index');



Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/debug', function () {
    logger('Debug route hit!');
    return 'Debug route worked!';
});


// Route::get('/about', function () {
//     return view('pages.about');
// }); 

Route::get('/about', [OfficialController::class, 'index'])->name('about');

Route::get('/whyjoin', function () {
    return view('pages.whyjoin');
}) ->name('whyjoin');

Route::get('/student', function () {
    return view('pages.student');
}) ->name('student');

Route::get('/partnership', function () {
    return view('pages.partnership');
}) ->name('partnership');

Route::get('/professional', function () {
    return view('pages.professional');
}) ->name('professional');




Route::get('/landing', [MemberTaskController::class, 'home',])->name('home');

Route::get('/user', function () {
    return view('admin.user-management');
});





Auth::routes([
    'verify' => true
]);

Route::middleware(['auth', 'member'])->group(function () {

Route::get('/job-board', [JobsController::class, 'index']) ->name('job-board');

Route::get('/resource', [MemberTaskController::class, 'resources'])->name('member.resource');

});

Route::get('/admin/jobList', [JobsController::class, 'jobList']) ->name('job-list');
Route::post('/jobs/store', [JobsController::class, 'storeJobs'])->name('jobs.store');




// Route::get('/home', [HomeController::class, 'index'])->name('index')->middleware('verified');
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('index');




Route::get('/porfolio', [MemberTaskController::class, 'portfolio'])->name('member.portfolio');
Route::get('/community', [MemberTaskController::class, 'community'])->name('member.community');
Route::get('/membership', [MemberTaskController::class, 'membership'])->name('membership');




Route::post('/update/user-profile/{id}', [MemberTaskController::class, 'update'])->name('update.user-profile');

Route::post('/store-experience', [MemberTaskController::class, 'storeExperience'])->name('store.experience');
Route::post('/store-education', [MemberTaskController::class, 'educationExperience'])->name('store.education');
Route::post('/store-skill', [MemberTaskController::class, 'storeSkill'])->name('store.skill');
Route::post('/store-resources', [MemberTaskController::class, 'storeResources'])->name('store.resources');
Route::post('/discussion/{discussion}/comment', [CommentController::class, 'store'])->name('store.comment');
Route::post('/manual-payments/store', [MemberTaskController::class, 'storeMembershipPayment'])->name('manual-payments.store');
Route::get('/download/{id}', [MemberTaskController::class, 'download'])->name('resource.download');



// manual-payments.store
Route::get('/manage-user', [AdminTaskController::class, 'user'])->name('manage-user');
Route::get('/calendar', [AdminTaskController::class, 'calendar'])->name('admin.calendar');
Route::get('/member', [AdminTaskController::class, 'member'])->name('admin.user');
// Route::get('/dashboard', [AdminTaskController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/store', [AdminTaskController::class, 'createPost'])->name('discussions.store');
Route::post('/store-event', [AdminTaskController::class, 'storeEvent'])->name('store.event');
Route::get('/resources', [AdminTaskController::class, 'resource'])->name('resource.management');
Route::post('/admin/approve-payment/{payment}', [ManualPaymentController::class, 'approvePayment'])->name('approve.request');




Route::get('/officials', [OfficialController::class, 'index'])->name('officials.index');
Route::get('/officials/create', [OfficialController::class, 'create'])->name('officials.create');
Route::post('/officials', [OfficialController::class, 'store'])->name('officials.store');
Route::get('/manage/officials', [OfficialController::class, 'officialManagement'])->name('admin.official');



Route::get('/chart/sales-data', [HomeController::class, 'getSalesChartData'])->name('chart.sales');
Route::get('/chart/membership', [HomeController::class, 'getMembershipDistribution'])->name('chart.membership');
Route::get('/chart/resources', [HomeController::class, 'getTotalResources'])->name('chart.resources');
Route::get('/chart/job', [HomeController::class, 'jobChart'])->name('chart.jobs');


// Route::get('', function () {
//     return view('admin.official');
// })->name('admin.official');

Route::get('/search', [SearchController::class, 'search'])->name('search');

// Show routes for search results
Route::get('/users/{id}', [SearchController::class, 'show'])->name('user.show');

Route::get('/forum', [AdminTaskController::class, 'communityModerator'])->name('community.moderator');


// Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
// Route::get('/resources/{id}', [ResourceController::class, 'show'])->name('resources.show');











