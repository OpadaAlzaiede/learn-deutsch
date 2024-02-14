<?php


namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageTranslateService
{
    protected const SOURCE_LANGUAGE = 'de';

    public static function translate(string $word, string $translateTo) {

        $tr = new GoogleTranslate();
        $tr->setSource(self::SOURCE_LANGUAGE);
        $tr->setTarget($translateTo);

        return $tr->translate($word);
    }
}
