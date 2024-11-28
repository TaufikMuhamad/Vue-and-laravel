<?php

namespace Tests\Feature;

use App\Models\Siswa;
use App\Models\Hobi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiswaTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_siswa()
    {
        $hobi = Hobi::create(['name' => 'Membaca']);
        $response = $this->postJson('/api/siswa', [
            'full_name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'degree' => 'S1',
            'hobi_id' => $hobi->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['full_name' => 'John Doe']);
    }

    public function test_get_all_siswa()
    {
        $response = $this->getJson('/api/siswa');
        $response->assertStatus(200);
    }
}

