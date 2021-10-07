<?php

namespace Tests\Feature;

use App\Models\Tweet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function a_user_can_see_his_own_tweets()
    {
        $tweet = Tweet::factory()->create();

        $this->actingAs($tweet->owner)
            ->get('/home')
            ->assertStatus(200)
            ->assertSee($tweet->body);
    }
}
