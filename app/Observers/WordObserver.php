<?php

namespace App\Observers;

use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WordObserver
{
    /**
     * Handle the Word "created" event.
     */
    public function created(Word $word): void
    {
        if(Auth::check()) $word->user_id = Auth::id();

        $word->word = ucfirst(Str::lower($word->word));
        $word->ar_translation = ucfirst(Str::lower($word->ar_translation));
        $word->en_translation = ucfirst(Str::lower($word->en_translation));

        $word->save();
    }
}
