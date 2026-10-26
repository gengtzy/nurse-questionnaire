<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'nip',
        'room',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function gameLogs(): HasMany
    {
        return $this->hasMany(GameLog::class);
    }

    public function latestPreTest(): HasOne
    {
        return $this->hasOne(Assessment::class)->where('type', 'pre_test')->latestOfMany();
    }

    public function latestPostTest(): HasOne
    {
        return $this->hasOne(Assessment::class)->where('type', 'post_test')->latestOfMany();
    }

    public function thankYouCards(): HasMany
    {
        return $this->hasMany(ThankYouCard::class);
    }

    public function latestThankYouCard(): HasOne
    {
        return $this->hasOne(ThankYouCard::class)->latestOfMany();
    }
}
