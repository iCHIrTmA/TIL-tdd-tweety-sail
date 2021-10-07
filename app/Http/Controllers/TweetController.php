<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => ['required', 'max:255'],
        ]);

        Tweet::create([
            'user_id' => auth()->user()->id,
            'body' => $request->body,
        ]);
    }
}
