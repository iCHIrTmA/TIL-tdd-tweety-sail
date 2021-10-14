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
            ->get(route('profiles.show', $user->username))
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
            ->get(route('profiles.show', $user->username))
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
            ->get(route('profiles.show', $second_user->username))
            ->assertStatus(200)
            ->assertDontSee('Edit Profile')
            ->assertSee('Follow me');
    }

    /**
     * @test
     */
    public function a_user_can_see_edit_page_for_his_own_profile():void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('profiles.edit', $user->username))
            ->assertStatus(200)
            ->assertSee('Hi ' . $user->name . ', You can edit your details here.');
    }

    /**
     * @test
     */
    public function a_user_cannot_see_edit_page_for_others_profile():void
    {
        $first_user = User::factory()->create();
        $second_user = User::factory()->create();

        $this->actingAs($first_user)
            ->get(route('profiles.edit', $second_user->username))
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function a_user_can_see_update_his_own_profile():void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $newData = [
            'username' => 'CHANGED_username',
            'name' => 'CHANGED name',
            'email' => 'CHANGED_email@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->patch(route('profiles.update', $user->username), $newData)
            ->assertStatus(200);

        // TODO: assert user wasRecentlyUpdate()
        
        $this->assertDatabaseHas('users', [
            'username' => $newData['username'],
            'name' => $newData['name'],
            'email' => $newData['email'],
        ]);
    }
}
