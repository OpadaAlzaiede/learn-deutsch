<?php

namespace App\Services;


use App\Jobs\TranslationJob;
use App\Models\Word;
use Illuminate\Pagination\LengthAwarePaginator;

class WordService {

    public function index(array $languageLevels, array $types): LengthAwarePaginator {

        return Word::query()
                    ->levels($languageLevels)
                    ->types($types)
                    ->orderBy('language_level_id')
                    ->paginate(10)
                    ->withQueryString()
                    ->through(fn ($word) => [
                        'id' => $word->id,
                        'word' => $word->word,
                        'ar_translation' => $word->ar_translation,
                        'en_translation' => $word->en_translation,
                        'type' => $word->type?->type,
                        'language_level' => $word->languageLevel?->level,
                        'user' => $word->user?->name
                    ]);
    }

    public function store(array $data): void {

        $word = Word::create([
            'word' => $data['word'],
            'language_level_id' => $data['language_level_id'],
            'type_id' => $data['type_id']
        ]);

        TranslationJob::dispatch($word);
    }
}
