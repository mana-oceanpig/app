<?php

use App\Http\Controllers\ConversationMessagesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/conversations', [ConversationsController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/start', [ConversationsController::class, 'start'])->name('conversations.start');
    Route::post('/conversations', [ConversationsController::class, 'store'])->name('conversations.store');
    Route::get('/usage-guide', [ConversationsController::class, 'showUsageGuide'])->name('usage.guide');
    Route::post('/mark-onboarding-seen', [ConversationsController::class, 'markOnboardingAsSeen'])->name('mark.onboarding.seen');
    
    Route::get('/conversations/{id}', [ConversationsController::class, 'show'])->name('conversations.show');
    Route::get('/conversations/{id}/listen', [ConversationsController::class, 'listen'])->name('conversations.listen');
    Route::get('/conversations/{id}/check-expired', [ConversationsController::class, 'checkExpired'])->name('conversations.checkExpired');
    Route::post('/conversations/{id}/complete', [ConversationsController::class, 'complete'])->name('conversations.complete');
    Route::post('/conversations/{id}/cancel', [ConversationsController::class, 'cancel'])->name('conversations.cancel');
    Route::post('/conversations/{id}/update-title', [ConversationsController::class, 'updateTitle'])->name('conversations.updateTitle');
    Route::delete('/conversations/{conversation}', [ConversationsController::class, 'destroy'])->name('conversations.destroy');
    Route::post('/conversations/{conversation}/update-last-activity', [ConversationsController::class, 'updateLastActivity'])->name('conversations.updateLastActivity');
    Route::post('/login-bonus', [ConversationsController::class, 'claimLoginBonus'])->name('login.bonus');
    Route::post('/check-login-status', [ConversationsController::class, 'checkLoginStatus'])->name('check.login.status');
    Route::post('/claim-login-bonus', [ConversationsController::class, 'claimLoginBonus'])->name('login.bonus');
    Route::get('/login-info', [ConversationsController::class, 'getLoginInfo']);
    
    Route::get('/conversations/{conversation}/messages', [ConversationMessagesController::class, 'store'])->name('conversationMessages.store');
    Route::post('/conversations/{conversation}/messages', [ConversationMessagesController::class, 'store'])->name('conversationMessages.store');
});

require __DIR__.'/auth.php';
