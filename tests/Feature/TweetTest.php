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
            ->get(route('home'))
            ->assertStatus(200)
            ->assertSee($tweet->owner->name)
            ->assertSee($tweet->body);
    }

    /**
     * @test
     */
    public function a_user_can_see_his_tweets_and_tweets_of_users_he_follows():void
    {
        $this->withoutExceptionHandling();
        // user to follow
        $first_user = User::factory()->create();

        // users to be followed
        $second_user = User::factory()->create();
        $third_user = User::factory()->create();

        // follow the users
        $first_user->follow($second_user);
        $first_user->follow($third_user);

        Tweet::factory()->create(['user_id' => $first_user]);
        Tweet::factory()->create(['user_id' => $second_user]);
        Tweet::factory()->create(['user_id' => $third_user]);

        $this->actingAs($first_user)
            ->get(route('home'))
            ->assertStatus(200)
            ->assertSee($first_user->tweets->first()->body)
            ->assertSee($second_user->tweets->first()->body)
            ->assertSee($third_user->tweets->first()->body);
    }

    /**
     * @test
     */
    public function user_can_publish_a_tweet(): void
    {
        // $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $tweet = ['body' => 'Hello World'];
    
        $this->actingAs($user)
            ->followingRedirects()
            ->post('/tweets', $tweet)
            ->assertStatus(200);

        $this->assertDatabaseHas('tweets', $tweet);
    }

    /**
     * @test
     */
    public function tweets_are_required(): void
    {
        $user = User::factory()->create();

        $tweet = ['body' => ''];
    
        $this->actingAs($user)
            ->post('/tweets', $tweet)
            ->assertSessionHasErrors('body');
    }
}
