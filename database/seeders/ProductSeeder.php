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
        $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum porro facilis qui blanditiis delectus, deleniti adipisci recusandae repellendus rerum perspiciatis sit illum. Distinctio incidunt voluptas id neque mollitia illo consequuntur.";

        $watches = [
            "Smart Watch 1",
            "Smart Watch 2",
            "Smart Watch 3",
            "Smart Watch 4",
            "Smart Watch 5",
        ];
        $watch_images = [
            "product_watch_1.jpg",
            "product_watch_2.jpg",
            "product_watch_3.jpg",
            "product_watch_4.jpg",
            "product_watch_5.jpg",
        ];
        foreach ($watches as $key => $watch) {
            Product::factory()->create([
                'title' => $watch,
                'slug' => Str::slug($watch),
                'description' => $description,
                'price' => rand(5000, 1350) . "00",
                'featured_image' => $watch_images[$key],
                'category_id' => 1,
                'stock' => 10,
            ],);
        }

        //Covers

        $covers = [
            "Cover 1",
            "Cover 2",
            "Cover 3",
        ];
        $cover_images = [
            "product_cover_1.jpg",
            "product_cover_2.jpg",
            "product_cover_3.jpg",
        ];
        foreach ($covers as $key => $cover) {
            Product::factory()->create([
                'title' => $cover,
                'slug' => Str::slug($cover),
                'description' => $description,
                'price' => rand(5000, 1350) . "00",
                'featured_image' => $cover_images[$key],
                'category_id' => 2,
                'stock' => 10,
            ],);
        }
        //Power Banks

        $power_banks = [
            "Power Bank 1",
            "Power Bank 2",
            "Power Bank 3",
            "Power Bank 4",
            "Power Bank 5",
        ];
        $power_bank_images = [
            "product_powerbank_1.jpg",
            "product_powerbank_2.jpg",
            "product_powerbank_3.jpg",
            "product_powerbank_4.jpg",
            "product_powerbank_5.jpg",
        ];
        foreach ($power_banks as $key => $power_bank) {
            Product::factory()->create([
                'title' => $power_bank,
                'slug' => Str::slug($power_bank),
                'description' => $description,
                'price' => rand(5000, 1350) . "00",
                'featured_image' => $power_bank_images[$key],
                'category_id' => 3,
                'stock' => 10,
            ],);
        }

        //Earphones

        $ear_phones = [
            "Ear Phone 1",
            "Ear Phone 2",
            "Ear Phone 3",
            "Ear Phone 4",
        ];
        $ear_phone_images = [
            "product_earphone_1.jpg",
            "product_earphone_2.jpg",
            "product_earphone_3.jpg",
            "product_earphone_4.jpg",
        ];
        foreach ($ear_phones as $key => $ear_phone) {
            Product::factory()->create([
                'title' => $ear_phone,
                'slug' => Str::slug($ear_phone),
                'description' => $description,
                'price' => rand(5000, 1350) . "00",
                'featured_image' => $ear_phone_images[$key],
                'category_id' => 4,
                'stock' => 10,
            ],);
        }

        Product::factory(100)->create();
    }
}
