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

    /**
     * @test
     */
    public function a_user_can_see_edit_button_but_cannot_see_follow_me_button_in_his_own_profile():void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('profiles.show', $user->name))
            ->assertStatus(200)
            ->assertSee('Edit Profile')
            ->assertDontSee('Follow me');
    }

    /**
     * @test
     */
    public function a_user_cannot_see_edit_button_but_cansee_follow_me_button_in_other_users_profile():void
    {
        $this->withoutExceptionHandling();

        $first_user = User::factory()->create();
        $second_user = User::factory()->create();

        $this->actingAs($first_user)
            ->get(route('profiles.show', $second_user->name))
            ->assertStatus(200)
            ->assertDontSee('Edit Profile')
            ->assertSee('Follow me');
    }
}
