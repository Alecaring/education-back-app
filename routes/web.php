<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatDiscussionController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PrivateMessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
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


});

require __DIR__ . '/auth.php';
