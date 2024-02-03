<?php

namespace App\Models;

use App\Observers\WordObserver;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['word', 'ar_translation', 'en_translation', 'language_level_id', 'type_id'];

    public static function boot() {

        parent::boot();

        self::observe(WordObserver::class);
    }

    public function languageLevel(): BelongsTo {

        return $this->belongsTo(LanguageLevel::class);
    }

    public function type(): BelongsTo {

        return $this->belongsTo(Type::class);
    }

    public function user(): BelongsTo {

        return $this->belongsTo(User::class);
    }
}
