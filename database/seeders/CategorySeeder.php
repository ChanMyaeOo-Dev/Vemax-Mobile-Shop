<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["cables", "cases", "chargers", "powerbanks"];
        $category_images = [
            "category_cable.jpg",
            "category_case.jpg",
            "category_charger.jpg",
            "category_powerbank.jpg",
        ];
        foreach ($categories as $key => $category) {
            Category::factory()->create([
                'title' => $category,
                'slug' => Str::slug($category),
                'image' => $category_images[$key],
            ]);
        }
    }
}
