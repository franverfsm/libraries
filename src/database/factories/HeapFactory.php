<?php

namespace Database\Factories;

use App\Models\Heap;
use Illuminate\Database\Eloquent\Factories\Factory;

final class HeapFactory extends Factory
{
    protected $model = Heap::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cep' => fake()->randomNumber(8),
            'address' => fake()->streetAddress(),
            'number' => fake()->numberBetween(1, 100000),
            'bourg' => fake()->name(),
            'city' => fake()->city(),
            'state' => fake()->name(),
        ];
    }
}
