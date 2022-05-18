<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;
use App\Models\Category;
use App\Models\Language;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence(),
            'price' => $this->faker->numberBetween(0,99900),
            // 'available' => $this->faker->boolean(),
            'available' => true,
            'author_id' => Author::all()->random()->author_id,
            'category_id' => Category::all()->random()->category_id,
            'language_id' => Language::all()->random()->language_id,
            'publication_year' => $this->faker->year()
        ];
    }
}
