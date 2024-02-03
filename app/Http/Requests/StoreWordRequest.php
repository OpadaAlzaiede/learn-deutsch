<?php

namespace App\Http\Requests;

use App\Rules\LanguageCheckRule;
use App\Rules\TranslationCheckRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWordRequest extends FormRequest
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
            'word' => ['required', 'string', Rule::unique('words', 'word'), new TranslationCheckRule()],
            'ar_translation' => ['required', 'string', new LanguageCheckRule("ar", "fa")],
            'en_translation' => ['required', 'string', new LanguageCheckRule("en")],
            'language_level_id' => ['required', Rule::exists('language_levels', 'id')],
            'type_id' => ['required', Rule::exists('types', 'id')],
        ];
    }
}
