<?php

namespace App\Jobs;

use App\Models\Word;
use App\Services\LanguageTranslateService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TranslationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Word $word)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $germanWord = $this->word->word;

        $arabicTranslation = LanguageTranslateService::translate($germanWord, 'ar');
        $englishTranslation = LanguageTranslateService::translate($germanWord, 'en');

        $this->word->ar_translation = $arabicTranslation;
        $this->word->en_translation = $englishTranslation;
    }
}
