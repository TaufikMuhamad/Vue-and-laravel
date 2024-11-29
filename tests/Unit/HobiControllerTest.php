<?php

namespace Tests\Feature;

use App\Models\Hobi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HobiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_hobi()
    {
        $response = $this->postJson('/api/hobi', [
            'name' => 'Football',
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment(['name' => 'Football']);
    }

    public function test_get_all_hobi()
    {
        Hobi::factory()->count(3)->create();

        $response = $this->getJson('/api/hobi');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}
