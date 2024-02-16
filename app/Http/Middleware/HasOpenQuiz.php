<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasOpenQuiz
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $openQuiz = $user->quizzes()
            ->isFinished(config('quiz.is_not_finished'))
            ->first();

        if(!is_null($openQuiz)) {

            return to_route('quizzes.questions', $openQuiz->id);
        }

        return $next($request);
    }
}
