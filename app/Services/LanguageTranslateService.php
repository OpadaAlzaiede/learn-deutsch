<?php


namespace App\Services;


use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageTranslateService
{
    protected const SOURCE_LANGUAGE = 'de';

    public static function checkTranslation(string $word, string $targetLanguage, string $translation): bool {

        $googleTranslation = GoogleTranslate::trans($word, $targetLanguage, self::SOURCE_LANGUAGE);

        return Str::upper($googleTranslation) === Str::upper($translation);
    }

    public static function validateLanguage(string $word, string $expectedLanguage, $alternativeLanguage = null): bool {

        $tr = new GoogleTranslate(self::SOURCE_LANGUAGE);
        $tr->translate($word);
        $detectedLanguage = $tr->getLastDetectedSource();

        if($detectedLanguage === $expectedLanguage) return true;

        if(!is_null($alternativeLanguage)) {

            return $detectedLanguage === $alternativeLanguage;
        }

        return false;
    }
}
