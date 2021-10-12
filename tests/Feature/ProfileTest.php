<?php

namespace Tests\Feature;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_see_his_own_profile_and_tweets():void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        Tweet::factory()->create(['user_id' => $user]);

        $this->actingAs($user)
            ->get(route('profiles.show', $user->name))
            ->assertStatus(200)
            ->assertSee($user->name)
            ->assertSee($user->tweets->first()->body);
    }
}
