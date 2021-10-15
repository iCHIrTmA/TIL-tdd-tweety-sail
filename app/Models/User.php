<?php

namespace App\Models;

use App\Traits\Followable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Followable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function timeline(): Collection
    {
        $followed_users_ids = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $followed_users_ids)
                ->orWhere('user_id', $this->id)
                ->latest()
                ->get();
    }

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function getAvatarAttribute($file)
    {
        return asset($file ? 'storage/' . $file : asset('images/default-avatar.jpg'));
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function likedTweets(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function like($tweet)
    {
        $this->likedTweets()->create(['tweet_id' => $tweet->id]);
    }

    public function unlike($tweet)
    {
        $this->likedTweets()
            ->where('user_id', $this->id)
            ->where('tweet_id', $tweet->id)
            ->delete();
    }
}
