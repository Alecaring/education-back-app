<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatDiscussionController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PrivateMessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\RewardController;

use App\Http\Controllers\TestController;

use App\Models\ChatDiscussion;
use App\Models\Material;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('courses', CourseController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('quizzes', QuizController::class);
    Route::resource('quiz_questions', QuizQuestionController::class);
    Route::resource('quiz_answers', QuizAnswerController::class);
    Route::resource('certificates', CertificateController::class);

    // Route::get('/chat', [ChatMessageController::class, 'index'])->name('chat.index');
    // Route::post('/chat', [ChatMessageController::class, 'store'])->name('chat.store');

    // Route::get('/chat/discussions', [ChatDiscussionController::class, 'index'])->name('chat.discussions.index');
    // Route::post('/chat/discussions', [ChatDiscussionController::class, 'store'])->name('chat.discussions.store');

    // Route::post('/chat/{discussionId}', [ChatMessageController::class, 'store'])->name('chat.store');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/discussion', [ChatController::class, 'storeDiscussion'])->name('chat.discussion.store');
    Route::post('/chat/message/{discussionId}', [ChatController::class, 'storeMessage'])->name('chat.message.store');

    Route::resource('materials', MaterialController::class);

    Route::get('/private-messages', [PrivateMessageController::class, 'index'])->name('private_messages.index');
    Route::post('/private-messages', [PrivateMessageController::class, 'store'])->name('private_messages.store');

    Route::get('/points/{userId}', [PointController::class, 'showPoints'])->name('points.show');

    Route::get('/rewards', [RewardController::class, 'index'])->name('rewards.index');
    Route::get('/rewards/check/{userId}', [RewardController::class, 'checkRewards'])->name('rewards.check');
    Route::post('/rewards/redeem', [RewardController::class, 'redeemReward'])->name('rewards.redeem');

    Route::post('/quizzes/complete/{quizId}', [QuizController::class, 'completeQuiz'])->name('quizzes.complete');

    Route::resource('quizzes', QuizController::class);
    Route::post('quizzes/{quizId}/complete', [QuizController::class, 'completeQuiz'])->name('quizzes.complete');
    Route::get('points', [RewardController::class, 'index'])->name('points.index');
    Route::get('rewards/{rewardId}/redeem', [RewardController::class, 'redeemReward'])->name('rewards.redeem');

    Route::resource('test', TestController::class);
    Route::get('/show-test/{id}', [TestController::class, 'show'])->name('test.show');
    Route::get('/show-materials/{id}', [TestController::class, 'showMaterials'])->name('test.showMaterials');
});

require __DIR__ . '/auth.php';
