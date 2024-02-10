<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['quiz_id', 'word_id', 'correct_solution', 'user_solution', 'is_correct'];

    public function word(): BelongsTo {

        return $this->belongsTo(Word::class);
    }
}
