<?php

namespace App\Rules;

use App\Services\LanguageTranslateService;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class TranslationCheckRule implements ValidationRule, DataAwareRule
{
    protected $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!LanguageTranslateService::checkTranslation($value, 'ar', $this->data['ar_translation'])) {
            $fail("Please check the arabic translation for the word {$value}");
        }

        if(!LanguageTranslateService::checkTranslation($value, 'en', $this->data['en_translation'])) {
            $fail("Please check the english translation for the word {$value}");
        }
    }
}
