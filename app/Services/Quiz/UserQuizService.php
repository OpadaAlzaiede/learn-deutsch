<?php


namespace App\Services\Quiz;


use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserQuizService implements WriteQuizService, QueryQuizService
{

    public function index() {

        return Quiz::query()
                    ->where('user_id', Auth::id())
                    ->where('is_finished', 1)
                    ->orderBy('date', 'DESC')
                    ->paginate(5)
                    ->withQueryString()
                    ->through(fn ($quiz) => [
                        'id' => $quiz->id,
                        'number_of_words' => $quiz->number_of_words,
                        'language_level' => $quiz->languageLevel?->level,
                        'score' => $quiz->score,
                        'date' => Carbon::parse($quiz->date)->format('Y/m/d')
                    ]);
    }

    public function show(int $id)
    {
        // TODO: Implement show() method.
    }

    public function store(array $data)
    {
        return Quiz::create([
            'language_level_id' => $data['language_level_id'],
            'user_id' => Auth::id(),
            'number_of_words' => $data['number_of_words'],
            'date' => Carbon::now()
        ]);
    }

    public function getById(int $id): Model
    {
        return Quiz::query()
                    ->where('user_id', Auth::id())
                    ->isFinished(config('quiz.is_not_finished'))
                    ->findOrFail($id);
    }

    public function destroy(int $id)
    {
        $quiz = Quiz::query()
                    ->where('user_id', Auth::id())
                    ->isFinished(config('quiz.is_finished'))
                    ->findOrFail($id);

        $quiz->delete();
    }

    public function cancel(int $id)
    {
        $quiz = Quiz::query()
            ->where('user_id', Auth::id())
            ->isFinished(config('quiz.is_not_finished'))
            ->findOrFail($id);

        $quiz->delete();
    }
}
