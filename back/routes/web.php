<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\CluesController;
use App\Http\Controllers\ContanctController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CreativeController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DiwanController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\GeniuseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemorizationController;
use App\Http\Controllers\SoundController;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\YoutubeController;

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


Route::get('/',[HomeController::class, 'index'])->name('home');


// Route::middleware('auth')->group(function () {

// });

Route::group(
    [
        "prefix" => "admin",
        'middleware' => ['auth',"throttle:80,2"]
    ],
    function () {

        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('register');
        Route::post('register', [RegisteredUserController::class, 'store']);


        Route::get('news/post', [NewsController::class, 'create'])->name('news-create');
        Route::post('news/store', [NewsController::class, 'store'])->name('news-store');
        Route::get('news/show', [NewsController::class, 'show'])->name('news-show');
        Route::get('news/edit/{id}', [NewsController::class, 'edit'])->name('news-edit');
        Route::put('news/update', [NewsController::class, 'update'])->name('news-update');
        Route::get('news/destroy/{id}', [NewsController::class, 'destroy'])->name('news-destroy');

        Route::get('home/edit', [HomeController::class, 'edit'])->name('home-edit');
        Route::put('home/update', [HomeController::class, 'update'])->name('home-update');
        Route::get('home/post', [HomeController::class, 'create'])->name('home-post');
        Route::post('home/store', [HomeController::class, 'store'])->name('home-store');

        Route::get('creative/post', [CreativeController::class, 'create'])->name('creative-post');
        Route::post('creative/store', [CreativeController::class, 'store'])->name('creative-store');
        Route::get('creative/edit', [CreativeController::class, 'edit'])->name('creative-edit');
        Route::put('creative/update', [CreativeController::class, 'update'])->name('creative-update');
        Route::get('creative-image/edit/{id}', [CreativeController::class, 'image_edit'])->name('creative-image-edit');
        Route::put('creative-image/update', [CreativeController::class, 'image_upload'])->name('creative-image-update');

        Route::get('activity/post', [ActivityController::class, 'create'])->name('activity-post');
        Route::post('activity/store', [ActivityController::class, 'store'])->name('activity-store');
        Route::get('activity/edit', [ActivityController::class, 'edit'])->name('activity-edit');
        Route::put('activity/update', [ActivityController::class, 'update'])->name('activity-update');
        Route::get('activity-image/edit/{id}', [ActivityController::class, 'image_edit'])->name('activity-image-edit');
        Route::put('activity-image/update', [ActivityController::class, 'image_upload'])->name('activity-image-update');

        Route::get('diwan/post', [DiwanController::class, 'create'])->name('diwan-post');
        Route::post('diwan/store', [DiwanController::class, 'store'])->name('diwan-store');
        Route::get('diwan/edit', [DiwanController::class, 'edit'])->name('diwan-edit');
        Route::put('diwan/update', [DiwanController::class, 'update'])->name('diwan-update');
        Route::get('diwan-image/edit/{id}', [DiwanController::class, 'image_edit'])->name('diwan-image-edit');
        Route::put('diwan-image/update', [DiwanController::class, 'image_upload'])->name('diwan-image-update');

        Route::get('memorization/post', [MemorizationController::class, 'create'])->name('memorization-post');
        Route::post('memorization/store', [MemorizationController::class, 'store'])->name('memorization-store');
        Route::get('memorization/edit', [MemorizationController::class, 'edit'])->name('memorization-edit');
        Route::put('memorization/update', [MemorizationController::class, 'update'])->name('memorization-update');
        Route::get('memorization-image/edit/{id}', [MemorizationController::class, 'image_edit'])->name('memorization-image-edit');
        Route::put('memorization-image/update', [MemorizationController::class, 'image_upload'])->name('memorization-image-update');

        Route::get('course/post', [CourseController::class, 'create'])->name('course-post');
        Route::post('course/store', [CourseController::class, 'store'])->name('course-store');
        Route::get('course/edit', [CourseController::class, 'edit'])->name('course-edit');
        Route::put('course/update', [CourseController::class, 'update'])->name('course-update');
        Route::get('course-image/edit/{id}', [CourseController::class, 'image_edit'])->name('course-image-edit');
        Route::put('course-image/update', [CourseController::class, 'image_upload'])->name('course-image-update');

        Route::get('geniuse/post', [GeniuseController::class, 'create'])->name('geniuse-post');
        Route::post('geniuse/store', [GeniuseController::class, 'store'])->name('geniuse-store');
        Route::get('geniuse/show', [GeniuseController::class, 'show'])->name('geniuse-show');
        Route::get('geniuse/edit/{id}', [GeniuseController::class, 'edit'])->name('geniuse-edit');
        Route::put('geniuse/update', [GeniuseController::class, 'update'])->name('geniuse-update');
        Route::get('geniuse/destroy/{id}', [GeniuseController::class, 'destroy'])->name('geniuse-destroy');

        Route::get('donate/post', [DonateController::class, 'create'])->name('donate-post');
        Route::post('donate/store', [DonateController::class, 'store'])->name('donate-store');
        Route::get('donate/show', [DonateController::class, 'show'])->name('donate-show');
        Route::get('donate/edit/{id}', [DonateController::class, 'edit'])->name('donate-edit');
        Route::put('donate/update', [DonateController::class, 'update'])->name('donate-update');
        Route::get('donate/destroy/{id}', [DonateController::class, 'destroy'])->name('donate-destroy');

        Route::get('youtube/post', [YoutubeController::class, 'create'])->name('youtube-post');
        Route::post('youtube/store', [YoutubeController::class, 'store'])->name('youtube-store');
        Route::get('youtube/edit', [YoutubeController::class, 'edit'])->name('youtube-edit');
        Route::put('youtube/update', [YoutubeController::class, 'update'])->name('youtube-update');

        Route::get('sound/post', [SoundController::class, 'create'])->name('sound-post');
        Route::post('sound/store', [SoundController::class, 'store'])->name('sound-store');
        Route::get('sound/edit', [SoundController::class, 'edit'])->name('sound-edit');
        Route::put('sound/update', [SoundController::class, 'update'])->name('sound-update');

        Route::get('director/post', [DirectorController::class, 'create'])->name('director-post');
        Route::post('director/store', [DirectorController::class, 'store'])->name('director-store');
        Route::get('director/show', [DirectorController::class, 'show'])->name('director-show');
        Route::get('director/edit/{id}', [DirectorController::class, 'edit'])->name('director-edit');
        Route::put('director/update', [DirectorController::class, 'update'])->name('director-update');

        Route::get('speech/post', [SpeechController::class, 'create'])->name('speech-post');
        Route::post('speech/store', [SpeechController::class, 'store'])->name('speech-store');
        Route::get('speech/edit', [SpeechController::class, 'edit'])->name('speech-edit');
        Route::put('speech/update', [SpeechController::class, 'update'])->name('speech-update');

        Route::get('slider/edit/{id}', [HomeController::class, 'image_edit'])->name('slider-edit');
        Route::put('slider/update', [HomeController::class, 'image_upload'])->name('slider-update');

        Route::get('clues/post', [CluesController::class, 'create'])->name('clues-post');
        Route::post('clues/store', [CluesController::class, 'store'])->name('clues-store');
        Route::get('clues/edit', [CluesController::class, 'edit'])->name('clues-edit');
        Route::put('clues/update', [CluesController::class, 'update'])->name('clues-update');
    }
)->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';

/*

Route::group([
    "prefix" => "itqan",
    "middleware" => ["throttle:80,2"], 
], function () {
    Route::get('/contact-us', [ContanctController::class, 'index'])->name('contact-us');
    Route::post('/contact-us/send-email', [ContanctController::class, 'send_email'])->name('contact-us/send-email');
    Route::get('/vision', [VisionController::class, 'index'])->name('vision');
    Route::get('/branche', [BrancheController::class, 'index'])->name('branche');
    Route::get('/speech', [SpeechController::class, 'index'])->name('speech');
    Route::get('/director', [DirectorController::class, 'index'])->name('director');
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/activity', [ActivityController::class, 'index'])->name('activity');
    Route::get('/diwan', [DiwanController::class, 'index'])->name('diwan');
    Route::get('/memorization', [MemorizationController::class, 'index'])->name('memorization');
    Route::get('/course', [CourseController::class, 'index'])->name('course');
    Route::get('/creative', [CreativeController::class, 'index'])->name('creative');
    Route::get('/news', [NewsController::class, 'index'])->name('index');
    Route::get('/news/{idOrTitle}/details', [NewsController::class, 'news_detail'])->name('news_detail');
    Route::get('/clues', [CluesController::class, 'index'])->name('clues');
    Route::get('/search', [NewsController::class, 'search'])->name('search');
    Route::get('/geniuse/{name}/details', [GeniuseController::class, 'detail_index'])->name('detail_index');
});
*/
