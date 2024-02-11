<?php

namespace App\Http\Requests\Quizzes;

use App\Models\Word;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StartNewQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $numberOfWordsAvailable = Word::where('language_level_id', $this->input('language_level_id'))->count();

        return [
            'language_level_id' => ['required', Rule::exists('language_levels', 'id')],
            'number_of_words' => ['required', 'numeric', 'min:1', 'max:'. min($numberOfWordsAvailable, config('quiz.maximum_number_of_words_allowed'), 20)]
        ];
    }
}
