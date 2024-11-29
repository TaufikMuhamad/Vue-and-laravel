<?php

namespace Database\Factories;

use App\Models\Hobi;
use Illuminate\Database\Eloquent\Factories\Factory;

class HobiFactory extends Factory
{
    protected $model = Hobi::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
