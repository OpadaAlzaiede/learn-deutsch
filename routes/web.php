<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\WordController;
use \App\Http\Controllers\Issues\WordIssueController;
use \App\Http\Controllers\QuizController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    /* Quizzes */
    Route::get('/quizzes/{id}/questions', [QuizController::class, 'getQuestions'])->name('quizzes.questions');
    Route::post('/quizzes/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::post('/quizzes/{id}/cancel', [QuizController::class, 'cancel'])->name('quizzes.cancel');


    Route::middleware(['has_open_quiz'])->group(function() {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        /* Words */
        Route::get('words/{id}/issue', [WordIssueController::class, 'create'])->name('words.issue.create');
        Route::post('words/{id}/issue', [WordIssueController::class, 'store'])->name('words.issue.store');
        Route::resource('/words', WordController::class);

        /* Quizzes */
        Route::post('quizzes', [QuizController::class, 'store'])->name('quizzes.store')->middleware('quiz_rate_limiter');
        Route::delete('quizzes/{id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
        Route::get('quizzes', [QuizController::class, 'index'])->name('quizzes.index');
        Route::get('quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
    });

});

Route::fallback(function () {

    return Inertia::render('Errors/404');
});

require __DIR__.'/auth.php';

