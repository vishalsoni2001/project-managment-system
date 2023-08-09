<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test Redirect if guest user trying to access
     *
     * @return void
     */
    public function it_should_redirect_if_guest_user_trying_to_access(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertStatus(302);
    }

    /**
     * @test Loggedin user can access
     *
     * @return void
     */
    public function it_should_accessed_by_loggedin_users(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('dashboard'));
        $response->assertStatus(200);
    }
}
