<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            "img_1.jpg",
            "img_2.jpg",
            "img_3.jpg",
            "img_4.jpg",
            "img_5.jpg",
            "img_6.jpg",
            "img_7.jpg",
            "img_8.jpg",
            "img_9.jpg",
        ];
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum porro facilis qui blanditiis delectus, deleniti adipisci recusandae repellendus rerum perspiciatis sit illum. Distinctio incidunt voluptas id neque mollitia illo consequuntur.";

        $products = [
            "Product_1",
            "Product_2",
            "Product_3",
            "Product_4",
            "Product_5",
            "Product_6",
            "Product_7",
            "Product_8",
            "Product_9",
        ];

        foreach ($images as $key => $image) {
            Product::factory()->create([
                'title' => $products[$key],
                'slug' => Str::slug($products[$key]),
                'description' => $description,
                'price' => rand(5000, 135000),
                'featured_image' => $image,
                'category_id' => Category::inRandomOrder()->first()->id,
                'stock' => 10,
            ],);
        }
        Product::factory(100)->create();
    }
}
