<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_user_is_redirected_from_login_page_to_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect(route('admin.dashboard'));
    }
}
