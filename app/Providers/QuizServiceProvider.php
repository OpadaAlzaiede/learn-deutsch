<?php


namespace App\Providers;


use App\Http\Controllers\QuizController;
use App\Services\Quiz\QueryQuizService;
use App\Services\Quiz\UserQuizService;
use App\Services\Quiz\WriteQuizService;
use Inertia\ServiceProvider;

class QuizServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->app->when(QuizController::class)
                    ->needs(WriteQuizService::class)
                    ->give(UserQuizService::class);

        $this->app->when(QuizController::class)
                    ->needs(QueryQuizService::class)
                    ->give(UserQuizService::class);
    }
}
