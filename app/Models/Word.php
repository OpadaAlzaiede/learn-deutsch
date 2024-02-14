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

    protected $fillable = ['word', 'language_level_id', 'type_id'];

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

    public function scopeLevels($query, array $levels) {

        $query->when($levels ?? null, function($query, $levels) {

            $levelNames = collect($levels)->flatten();

            $query->whereHas('languageLevel', function($levelQuery) use ($levelNames){

                $levelQuery->whereIn('level', $levelNames);
            });
        });
    }

    public function scopeTypes($query, array $types): void {

        $query->when($types ?? null, function($query, $types) {

            $typeNames = collect($types)->flatten();

            $query->whereHas('type', function($typeQuery) use ($typeNames){

                $typeQuery->whereIn('type', $typeNames);
            });
        });
    }
}
