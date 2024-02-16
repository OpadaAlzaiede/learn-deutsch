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

        $openQuiz = $user->quizzes()->where('is_finished', 0)->first();

        if(!is_null($openQuiz)) {

            session()->flash('message', 'please submit your quiz first.');
            session()->flash('success', false);

            return to_route('quizzes.questions', $openQuiz->id);
        }

        return $next($request);
    }
}
