<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'language_level_id', 'date', 'score', 'number_of_words'];

    public function languageLevel(): BelongsTo {

        return $this->belongsTo(LanguageLevel::class);
    }

    public function questions(): HasMany {

        return $this->hasMany(Question::class);
    }

    public function scopeIsFinished(Builder $query): void {

        $query->where('is_finished', 0);
    }
}
