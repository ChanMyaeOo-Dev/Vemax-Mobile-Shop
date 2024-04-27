<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        $title = fake()->name();
        $description = fake()->realTextBetween(400, 500);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $description,
            'price' => rand(5000, 135000),
            'featured_image' => "default_image.svg",
            'category_id' => Category::inRandomOrder()->first()->id,
            'stock' => 10,
        ];
    }
}
