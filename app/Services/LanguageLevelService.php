<?php


namespace App\Services;


use App\Models\LanguageLevel;
use Illuminate\Support\Facades\Cache;

class LanguageLevelService
{
    public function index() {

        return Cache::remember('language_levels', 24 * 60, function () {

            return LanguageLevel::all();
        });
    }
}
