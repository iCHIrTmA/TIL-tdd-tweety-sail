<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(User $user, Tweet $tweet)
    {
        // dd($user, $tweet);
        $user->like($tweet);

        return response(200);
    }

    public function destroy(User $user, Tweet $tweet)
    {
        $user->unlike($tweet);

        return response(200);
    }
}
