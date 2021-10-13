<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Followable
{
    public function follow(User $user_to_follow)
    {
        $this->follows()->save($user_to_follow);
    }

    public function unfollow(User $user_to_unfollow)
    {
        $this->follows()->detach($user_to_unfollow);
    }

    public function follows(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    public function isFollowing(User $user_in_question): bool
    {
        return $this->follows()->where('following_user_id', $user_in_question->id)->exists();
    }
}