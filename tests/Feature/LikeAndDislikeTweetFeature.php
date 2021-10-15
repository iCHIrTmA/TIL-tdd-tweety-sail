<?php

namespace Tests\Feature;

use App\Models\Like;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeAndDislikeTweetFeature extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_like_a_tweet():void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();

        // transfer to Like unit test
        $this->assertInstanceOf(HasMany::class, $user->likedTweets());

        $this->assertCount(0, $user->likedTweets);

        $this->actingAs($user)
            ->post(route('like.store', [$user, $tweet]))
            ->assertStatus(200);

        $this->assertCount(1, $user->fresh()->likedTweets);

        // transfer to Like unit test
        $this->assertInstanceOf(Like::class, $user->fresh()->likedTweets->first());
    }

    /**
     * @test
     */
    public function a_user_can_unlike_a_tweet():void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $tweet = Tweet::factory()->create();

        // like a tweet
        $this->actingAs($user)
            ->post(route('like.store', [$user, $tweet]))
            ->assertStatus(200);

        $this->assertCount(1, $user->likedTweets);

        // unlike a tweet
        $this->actingAs($user)
        ->delete(route('like.destroy', [$user, $tweet]))
        ->assertStatus(200);

        $this->assertCount(0, $user->fresh()->likedTweets);
    }
}
