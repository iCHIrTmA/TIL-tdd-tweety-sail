<?php

namespace Tests\Feature;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_see_his_own_tweets():void
    {
        $tweet = Tweet::factory()->create();

        $this->actingAs($tweet->owner)
            ->get('/home')
            ->assertStatus(200)
            ->assertSee($tweet->owner->name)
            ->assertSee($tweet->body);
    }

    /**
     * @test
     */
    public function user_publish_a_tweet(): void
    {
        $user = User::factory()->create();

        $tweet = ['body' => 'Hello World'];
    
        $this->actingAs($user)
            ->post('/tweets', $tweet)
            ->assertStatus(200);

        $this->assertDatabaseHas('tweets', $tweet);
    }
}
