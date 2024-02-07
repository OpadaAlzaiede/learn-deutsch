<?php

namespace App\Rules;

use App\Services\LanguageTranslateService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use function Nette\Utils\match;

class LanguageCheckRule implements ValidationRule
{

    public function __construct(protected string $language, protected ?string $alternativeLanguage = null)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!LanguageTranslateService::validateLanguage($value, $this->language, $this->alternativeLanguage)) {
            $fail("The {$attribute} field must a be a valid {$this->getExpectedLanguage($this->language)} word.");
        }
    }

    protected function getExpectedLanguage(string $exp): string {

        return match($exp) {
            "ar" => "Arabic",
            "en" => "English",
            "de" => "German",
            default => "German",
        };
    }

}
