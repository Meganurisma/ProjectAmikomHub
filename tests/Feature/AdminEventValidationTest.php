<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEventValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_requires_stock_to_be_at_least_one_when_creating_an_event(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',
        ]);

        $response = $this->actingAs($user)->post(route('admin.events.store'), [
            'category_id' => 1,
            'title' => 'Laravel Meetup',
            'description' => 'Event testing',
            'date' => '2026-07-01 19:00:00',
            'location' => 'Yogyakarta',
            'price' => 50000,
            'stock' => 0,
        ]);

        $response->assertSessionHasErrors('stock');
        $this->assertDatabaseMissing('events', [
            'title' => 'Laravel Meetup',
        ]);
    }
}
