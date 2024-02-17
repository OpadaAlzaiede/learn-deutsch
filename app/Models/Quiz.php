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

    public function scopeLevels($query, array $levels) {

        $query->when($levels ?? null, function($query, $levels) {

            $levelNames = collect($levels)->flatten();

            $query->whereHas('languageLevel', function($levelQuery) use ($levelNames){

                $levelQuery->whereIn('level', $levelNames);
            });
        });
    }

    public function scopeIsFinished(Builder $query, string $status): void {

        $query->where('is_finished', $status);
    }
}
