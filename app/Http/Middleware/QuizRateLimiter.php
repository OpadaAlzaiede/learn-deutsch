<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuizRateLimiter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $quizzesCount = $user->quizzes()->withTrashed()->whereDay('date', Carbon::now()->day)->count();

        if($quizzesCount >= config('quiz.maximum_count_allowed_per_day')) {

            session()->flash('message', 'cannot start new quiz, you have reached the maximum number of quizzes allowed today.');
            session()->flash('success', false);

            return to_route('quizzes.index');
        }

        return $next($request);
    }
}
