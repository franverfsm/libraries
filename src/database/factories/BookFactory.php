<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

final class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => fake()->text(150),
            'description' => fake()->text(255),
            'author' => fake()->name(),
            'pages' => fake()->numberBetween(2, 5000),
        ];
    }
}
