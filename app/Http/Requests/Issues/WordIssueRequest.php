<?php

namespace App\Http\Requests\Issues;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WordIssueRequest extends FormRequest
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
        return [
            'issue_title' => ['required', 'string', 'max:100'],
            'suggested_solution' => ['required'],
            'word_id' => ['required', 'int', Rule::exists('words', 'id')]
        ];
    }
}
