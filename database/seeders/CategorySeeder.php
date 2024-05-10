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
        $categories = ["Smart watches", "Phone Covers", "Power Banks", "Earphones"];
        $category_images = [
            "category_watch.jpg",
            "category_phone_case.jpg",
            "category_powerbank.jpg",
            "category_earphone.jpg",
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
