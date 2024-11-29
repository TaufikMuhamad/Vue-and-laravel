<?php

namespace Tests\Feature;

use App\Models\Siswa;
use App\Models\Hobi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiswaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_siswa()
{
    $hobi = Hobi::factory()->create();

    $response = $this->postJson('/api/siswa', [
        'full_name' => 'Sabrun',
        'email' => 'sabrun@example.com',
        'degree' => 'S1',
        'hobi_id' => [$hobi->id],
    ]);


    $response->assertStatus(201);
    $response->assertJsonFragment([
        'full_name' => 'Sabrun',
        'email' => 'sabrun@example.com',
    ]);

    $this->assertDatabaseHas('siswa', [
        'full_name' => 'Sabrun',
        'email' => 'sabrun@example.com',
    ]);


    $this->assertDatabaseHas('hobi_siswa', [
        'siswa_id' => $response->json('id'),
        'hobi_id' => $hobi->id,
    ]);
}


    public function test_get_single_siswa()
    {

        $siswa = Siswa::factory()->create();

        $response = $this->getJson("/api/siswa/{$siswa->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['full_name' => $siswa->full_name]);
    }

    public function test_update_siswa()
    {

        $siswa = Siswa::factory()->create();
        $hobi = Hobi::factory()->create();

        $response = $this->putJson("/api/siswa/{$siswa->id}", [
            'full_name' => 'Asep',
            'email' => 'asep@example.com',
            'degree' => 'S2',
            'hobi_id' => [$hobi->id],
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'full_name' => 'Asep',
            'email' => 'asep@example.com',
        ]);

        $this->assertDatabaseHas('siswa', [
            'id' => $siswa->id,
            'full_name' => 'Asep',
            'email' => 'asep@example.com',
        ]);
    }

    public function test_delete_siswa()
    {
        $siswa = Siswa::factory()->create();

        $response = $this->deleteJson("/api/siswa/{$siswa->id}");

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Siswa berhasil dihapus']);

        $this->assertDatabaseMissing('siswa', [
            'id' => $siswa->id,
        ]);
    }
}
