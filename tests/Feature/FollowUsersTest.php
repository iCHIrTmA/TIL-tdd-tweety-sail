<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FollowUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_follow_and_unfollow_other_users():void
    {
        $this->withoutExceptionHandling();

        $first_user = User::factory()->create(['name' => 'first_user']);
        $second_user = User::factory()->create(['name' => 'second_user']);

        // follow second_user
        $this->actingAs($first_user)
            ->followingRedirects()
            ->post(route('follows.store', $second_user))
            ->assertStatus(200);

        $this->assertTrue($first_user->follows->contains($second_user));
        $this->assertTrue($first_user->isFollowing($second_user));


        // unfollow second_user
        $this->actingAs($first_user)
            ->followingRedirects()
            ->post(route('follows.store', $second_user))
            ->assertStatus(200);

        $this->assertFalse($first_user->fresh()->follows->contains($second_user));
        $this->assertFalse($first_user->isFollowing($second_user));
    }
}
