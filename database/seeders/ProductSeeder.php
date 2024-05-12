<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    protected $counter = 1;

    public function run()
    {
        $description = "200W GESAMTLEISTUNG: Ausgestattet mit zwei leistungsstarken USB-C-Anschlüssen und einem USB-A Anschluss mit einer Gesamtleistung von 200W, für maximale Effizienz! Lade mit deiner Powerbank zwei Laptops gleichzeitig schnell mit jeweils 100W.
SCHNELL WIEDERAUFGELADEN: Durch die 100W-Schnellaufladung über den USB-C-Anschluss und die Anker Prime-Ladestation ist die Powerbank in 1 Stunde und 15 Minuten vollständig aufgeladen.
POWER ZUM MITNEHMEN: Mit seinem kleinen, kompakten Design mit den Maßen 126,9 x 54,6 x 49,6mm passt die 20.000mAh Powerbank perfekt in deine Laptoptasche oder deinen Rucksack, ideal für unterwegs.
INFOS & UPDATES: Vollständige Kontrolle und Übersicht dank dem praktischen Display, welches Kapazität, Akkuleistung deiner Powerbank anzeigt.";

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
            $current_id = $this->generateUniqueId();
            Product::factory()->create([
                'id' => $current_id,
                'title' => $watch,
                'slug' => Str::slug($watch),
                'description' => $description,
                'price' => rand(5000, 1350) . "00",
                'featured_image' => $watch_images[$key],
                'category_id' => 1,
                'stock' => 10,
            ],);
            foreach ($watch_images as $img) {
                Photo::factory()->create([
                    "product_id" => $current_id,
                    "image" => $img
                ]);
            }
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
            $current_id = $this->generateUniqueId();
            Product::factory()->create([
                'id' => $current_id,
                'title' => $cover,
                'slug' => Str::slug($cover),
                'description' => $description,
                'price' => rand(5000, 1350) . "00",
                'featured_image' => $cover_images[$key],
                'category_id' => 2,
                'stock' => 10,
            ],);
            foreach ($cover_images as $img) {
                Photo::factory()->create([
                    "product_id" => $current_id,
                    "image" => $img
                ]);
            }
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
            $current_id = $this->generateUniqueId();

            Product::factory()->create([
                'id' => $current_id,
                'title' => $power_bank,
                'slug' => Str::slug($power_bank),
                'description' => $description,
                'price' => rand(5000, 1350) . "00",
                'featured_image' => $power_bank_images[$key],
                'category_id' => 3,
                'stock' => 10,
            ],);
            foreach ($power_bank_images as $img) {
                Photo::factory()->create([
                    "product_id" => $current_id,
                    "image" => $img
                ]);
            }
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
            $current_id = $this->generateUniqueId();

            Product::factory()->create([
                'id' => $current_id,
                'title' => $ear_phone,
                'slug' => Str::slug($ear_phone),
                'description' => $description,
                'price' => rand(5000, 1350) . "00",
                'featured_image' => $ear_phone_images[$key],
                'category_id' => 4,
                'stock' => 10,
            ],);
            foreach ($ear_phone_images as $img) {
                Photo::factory()->create([
                    "product_id" => $current_id,
                    "image" => $img
                ]);
            }
        }

        Product::factory(100)->create();
    }

    protected function generateUniqueId()
    {
        return $this->counter++;
    }
}
