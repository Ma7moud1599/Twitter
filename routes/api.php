<?php

use App\Http\Controllers\Api\Media\MediaController;
use App\Http\Controllers\Api\Media\MediaTypesController;
use App\Http\Controllers\Api\Notifications\NotificationController;
use App\Http\Controllers\Api\Timeline\TimelineController;
use App\Http\Controllers\Api\Tweets\TweetController;
use App\Http\Controllers\Api\Tweets\TweetLikeController;
use App\Http\Controllers\Api\Tweets\TweetQuoteController;
use App\Http\Controllers\Api\Tweets\TweetReplyController;
use App\Http\Controllers\Api\Tweets\TweetRetweetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::get('/timeline', [TimelineController::class, 'index']);

    Route::get('/tweets', [TweetController::class, 'store']);

    Route::get('/tweets/{tweet}/replies', [TweetReplyController::class, 'store']);

    Route::get('/tweets/{tweet}/likes', [TweetLikeController::class, 'store']);

    Route::get('/tweets/{tweet}/likes', [TweetLikeController::class, 'destroy']);

    Route::get('/tweets/{tweet}/retweets', [TweetRetweetController::class, 'store']);

    Route::get('/tweets/{tweet}/retweets', [TweetRetweetController::class, 'destroy']);

    Route::get('/tweets/{tweet}/quotes', [TweetQuoteController::class, 'store']);

    Route::get('/media', [MediaController::class, 'store']);

    Route::get('/media/types', [MediaTypesController::class, 'index']);

    Route::get('/notifications', [NotificationController::class, 'index']);
});
