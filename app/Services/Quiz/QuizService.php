<?php


namespace App\Services\Quiz;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Word;
use Illuminate\Database\Eloquent\Model;

class QuizService
{
    public function generateQuestions(int $quizId, int $languageLevelId, int $numberOfQuestions = 1): void {

        $wordsArray = [];

         for ($i = 1; $i <= $numberOfQuestions; $i++) {

             $word = $this->getNewWord($wordsArray, $languageLevelId);

             $this->generateQuestion($quizId, $word);

             array_push($wordsArray, $word->id);
         }
    }

    public function calculateResult(int $quizId, array $solutions) {

        $quiz = Quiz::find($quizId);
        $numberOfCorrectAnswers = 0;

        $questions = $quiz->questions;

        foreach ($questions as $question) {

            $questionAnswer = $solutions[$question->id];

            if($questionAnswer === $question->correct_solution) {

                $numberOfCorrectAnswers++;
            }
        }

        $quiz->score = $numberOfCorrectAnswers;
        $quiz->is_finished = 1;

        $quiz->questions()->delete();
        $quiz->save();
    }

    protected function getNewWord(array $words, int $languageLevelId): Model {

        return Word::query()
                    ->where('language_level_id', $languageLevelId)
                    ->whereNotIn('id', $words)
                    ->inRandomOrder()
                    ->first();
    }

    protected function generateQuestion(int $quizId, Word $word): void {

        Question::create([
            'quiz_id' => $quizId,
            'word_id' => $word->id,
            'correct_solution' => $word->type_id
        ]);
    }
}
