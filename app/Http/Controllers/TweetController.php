<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = current_user()->timeline();
        
        return view('tweets.index', compact('tweets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => ['required', 'max:255'],
        ]);

        Tweet::create([
            'user_id' => current_user()->id,
            'body' => $request->body,
        ]);

        return redirect(route('home'));
    }
}
