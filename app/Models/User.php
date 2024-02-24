<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function quizzes(): HasMany {

        return $this->hasMany(Quiz::class)->orderBy('date', 'DESC');
    }

    public function issues(): HasMany {

        return $this->hasMany(Issue::class);
    }

    public function scopeRole($query, string $role): void {

        $query->whereHas('roles', function ($q) use ($role){

            return $q->where('name', $role);
        });
    }

    public function scopeName($query, ?string $keyword): void {

        $query->when($keyword, function($query, $keyword) {

            $query->where('name', 'LIKE', '%'.$keyword.'%');
        });
    }

    public function isBlocked(): bool {

        return $this->is_blocked;
    }
}
