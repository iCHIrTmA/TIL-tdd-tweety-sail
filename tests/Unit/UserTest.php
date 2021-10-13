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
    public function userCanFollowOtherUser(): void
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
}
