<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DiwanController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CluesController;
use App\Http\Controllers\MemorizationController;
use App\Http\Controllers\CreativeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContanctController;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\GeniuseController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\SoundController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CompetitionApplicationController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/home/API', [HomeController::class, 'api_index'])->name('indexAPI');
Route::post('/home/visitors/API', [HomeController::class, 'visitorsCounter']);
Route::get('/activity/API', [ActivityController::class, 'api_index'])->name('indexAPI');
Route::get('/diwan/API', [DiwanController::class, 'api_index'])->name('indexAPI');
Route::get('/course/API', [CourseController::class, 'api_index'])->name('indexAPI');
Route::get('/clues/API', [CluesController::class, 'api_index'])->name('indexAPI');
Route::get('/memorization/API', [MemorizationController::class, 'api_index'])->name('indexAPI');
Route::get('/creative/API', [CreativeController::class, 'api_index'])->name('indexAPI');
Route::post('/contact-us/send-email', [ContanctController::class, 'send_email_api'])->name('contact-us/send-email');
Route::get('/search', [NewsController::class, 'search_api'])->name('search');
Route::get('/speech', [SpeechController::class, 'api_index'])->name('speech');
Route::get('/news/API', [NewsController::class, 'api_index'])->name('news');
Route::get('/news/{idOrTitle}/details/API', [NewsController::class, 'api_news_detail'])->name('api_news_detail');
Route::get('/news/{id}/API', [NewsController::class, 'api_news_detail_by_id'])->name('api_news_detail_by_id');
Route::get('/home/visitors/API', [HomeController::class, 'getVisitors']);
Route::post('/login/API', [AuthenticatedSessionController::class, 'storeApi']);
Route::get('/get/sections/API', [SectionController::class, 'index']);
Route::get('/sections/{title}/API', [SectionController::class, 'getByTitle']);
Route::get('/directors/tree', [DirectorController::class, 'getTree']);
Route::get('/events/API', [EventController::class, 'index']);
Route::get('/events/{id}/API', [EventController::class, 'show']);
Route::post('/events/{id}/comment/API', [EventController::class, 'addComment']);
Route::post('/events/{id}/like/API', [EventController::class, 'like']);
Route::post('/events/{id}/view/API', [EventController::class, 'incrementViews']);
Route::post('/competition/API', [CompetitionApplicationController::class, 'store']);
Route::post('/competition/upload-chunk/API', [CompetitionApplicationController::class, 'uploadVideoChunk']);

// ─── Stripe / Donation (public) ─────────────────────────────────────
Route::post('/donate/public/checkout', [DonateController::class, 'checkout']);
Route::post('/stripe/webhook', [DonateController::class, 'stripeWebhook']);

// Route::post('/login/API', [AuthenticatedSessionController::class, 'createApi'])->name('login');
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/news/API/admin', [NewsController::class, 'api_index_admin'])->name('news');
    Route::post('/news/store/API', [NewsController::class, 'storeApi'])->name('news-store');
    Route::patch('/news/update/{id}/API', [NewsController::class, 'updateApi'])->name('newsApi-update');
    Route::patch('/news/status/{id}/API', [NewsController::class, 'updateStatus']);
    Route::delete('/news/delete/{id}/API', [NewsController::class, 'deleteApi'])->name('newsApi-delete');
    Route::apiResource('/sections/API', SectionController::class)->except(['update', 'destroy']);
    Route::patch('/sections/{id}/API', [SectionController::class, 'update']);
    Route::delete('/sections/{id}/API', [SectionController::class, 'destroy']);
    Route::get('/donate/API', [DonateController::class, 'api_index']);
    Route::post('/donate/API', [DonateController::class, 'api_store']);
    Route::patch('/donate/{id}/API', [DonateController::class, 'api_update']);
    Route::patch('/donate/status/{id}/API', [DonateController::class, 'updateStatus']);
    Route::delete('/donate/{id}/API', [DonateController::class, 'api_destroy']);
    Route::get('/geniuse/API', [GeniuseController::class, 'api_index']);
    Route::post('/geniuse/API', [GeniuseController::class, 'api_store']);
    Route::patch('/geniuse/{id}/API', [GeniuseController::class, 'api_update']);
    Route::patch('/geniuse/status/{id}/API', [GeniuseController::class, 'updateStatus']);
    Route::delete('/geniuse/{id}/API', [GeniuseController::class, 'api_destroy']);
    Route::get('/clue/API', [CluesController::class, 'api_index']);
    Route::post('/clue/API', [CluesController::class, 'api_store']);
    Route::patch('/clue/{id}/API', [CluesController::class, 'api_update']);
    Route::get('/speech/API', [SpeechController::class, 'api_index'])->name('speech');
    Route::post('/speech/API', [SpeechController::class, 'api_store']);
    Route::patch('/speech/{id}/API', [SpeechController::class, 'api_update']);
    Route::post('/youtube/API', [YoutubeController::class, 'api_store']);
    Route::patch('/youtube/{id}/API', [YoutubeController::class, 'api_update']);
    Route::post('/sound/API', [SoundController::class, 'api_store']);
    Route::patch('/sound/{id}/API', [SoundController::class, 'api_update']);
    Route::patch('home/{id}/API', [HomeController::class, 'api_update']);
    Route::post('home/API', [HomeController::class, 'api_store']);
    Route::post('slider/API', [HomeController::class, 'api_image_store']);
    Route::patch('slider/{id}/API', [HomeController::class, 'api_image_upload']);
    Route::delete('slider/{id}/API', [HomeController::class, 'api_image_destroy']);
    Route::prefix('directors')->group(function () {
        // Route::get('/tree', [DirectorController::class, 'getTree']);
        Route::get('/tree/{id}', [DirectorController::class, 'getSubTree']);
        Route::get('/', [DirectorController::class, 'index']);
        Route::get('/{id}', [DirectorController::class, 'show']);
        Route::post('/', [DirectorController::class, 'store']);
        Route::put('/{id}', [DirectorController::class, 'update']);
        Route::patch('/{id}', [DirectorController::class, 'update']);
        Route::delete('/{id}', [DirectorController::class, 'destroy']);
        Route::get('/{id}/children', [DirectorController::class, 'getChildren']);
        Route::get('/{id}/ancestors', [DirectorController::class, 'getAncestors']);
    });

    // ─── Events (admin) ────────────────────────────────────────────────// Events (admin) 
    Route::get('/events/API/admin', [EventController::class, 'adminIndex']);
    Route::post('/events/API', [EventController::class, 'store']);
    Route::patch('/events/{id}/API', [EventController::class, 'update']);
    Route::delete('/events/{id}/API', [EventController::class, 'destroy']);
    Route::patch('/events/comments/{id}/status/API', [EventController::class, 'updateCommentStatus']);
    Route::get('/events/{id}/admin-comments/API', [EventController::class, 'getAdminComments']);
    Route::get('/competition/API/admin', [CompetitionApplicationController::class, 'index']);
    Route::delete('/competition/{id}/API', [CompetitionApplicationController::class, 'destroy']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroyApi'])
        ->name('logout');
});
