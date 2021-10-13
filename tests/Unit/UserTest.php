<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function userCanFollowOtherUsers(): void
    {
        $this->withoutExceptionHandling();

        // make two users
        $first_user = User::factory()->create(['name' => 'first_user']);
        $second_user = User::factory()->create(['name' => 'second_user']);
        $third_user = User::factory()->create(['name' => 'third_user']);

        // make first user follow the second user
        $first_user->follow($second_user);

        // assert follows relationship
        $this->assertCount(1, $first_user->follows);

        // follow another user
        // TODO: use tap() for fresh()
        $first_user->follow($third_user);

        $this->assertCount(2, $first_user->fresh()->follows);
    }

    /**
     * @test
     */
    public function userCanUnfollowOtherUsers(): void
    {
        $this->withoutExceptionHandling();

        // make two users
        $first_user = User::factory()->create(['name' => 'first_user']);
        $second_user = User::factory()->create(['name' => 'second_user']);
        $third_user = User::factory()->create(['name' => 'third_user']);

        $this->assertCount(0, $first_user->follows);

        // make first user follow the second user
        $first_user->follow($second_user);
        $first_user->follow($third_user);

        $this->assertCount(2, $first_user->fresh()->follows);

        $first_user->unfollow($second_user);
        $this->assertCount(1, $first_user->fresh()->follows);

        $first_user->unfollow($third_user);
        $this->assertCount(0, $first_user->fresh()->follows);
    }

    /**
     * @test
     */
    public function a_user_can_check_if_he_follows_a_certain_user(): void
    {
        $this->withoutExceptionHandling();

        $first_user = User::factory()->create(['name' => 'first_user']);
        $second_user = User::factory()->create(['name' => 'followed_user']);
        $third_user = User::factory()->create(['name' => 'user_not_followed']);

        $first_user->follow($second_user);

        $this->assertTrue($first_user->isFollowing($second_user));
        $this->assertFalse($first_user->isFollowing($third_user));

        $first_user->follow($third_user);
        $this->assertTrue($first_user->isFollowing($third_user));

        $first_user->unfollow($second_user);
        $this->assertFalse($first_user->isFollowing($second_user));
    }

    /**
     * @test
     */
    public function a_user_belongs_to_many_user_through_pivot_table(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(BelongsToMany::class, $user->follows());
        // TODO: assert pivot table
    }

    /**
     * @test
     */
    public function a_user_has_many_tweets(): void
    {
        $user = User::factory()->create();
        
        $this->assertInstanceOf(HasMany::class, $user->tweets());
    }

    // TODO: test for toggleFollow
}
