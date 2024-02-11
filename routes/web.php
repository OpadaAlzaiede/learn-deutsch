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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* Words */
    Route::get('words/{id}/issue', [WordIssueController::class, 'create'])->name('words.issue.create');
    Route::post('words/{id}/issue', [WordIssueController::class, 'store'])->name('words.issue.store');
    Route::resource('/words', WordController::class);

    /* Quizzes */
    Route::get('/quizzes/{id}/questions', [QuizController::class, 'getQuestions'])->name('quizzes.questions');
    Route::post('/quizzes/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::resource('/quizzes', QuizController::class);
});

require __DIR__.'/auth.php';

