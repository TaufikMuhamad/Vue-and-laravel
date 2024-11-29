<?php

namespace Database\Factories;

use App\Models\Siswa;
use App\Models\Hobi;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'degree' => $this->faker->word,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Siswa $siswa) {
            $hobi = Hobi::factory()->create();
            $siswa->hobi()->attach($hobi->id);
        });
    }
}
