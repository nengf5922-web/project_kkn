<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Data produk dari SQL dump
        $products = [
            ['name' => 'Strideelle Gold', 'slug' => 'strideelle-gold', 'category' => 'Wedding Heels', 'description' => 'Wedding Heels impian', 'price' => 800000, 'sizes' => null, 'image' => '1766041238_faf46337-dd64-452a-b1cc-bcb3ae51c24f.jpeg'],
            ['name' => 'Strideelle Boots Black', 'slug' => 'strideelle-boots-black', 'category' => 'Boots', 'description' => 'Boots elegan untuk Menunjang penampilanmu', 'price' => 750000, 'sizes' => null, 'image' => '1766383759_b3.jpeg'],
            ['name' => 'Strideelle Sneaker Chicks', 'slug' => 'strideelle-sneaker-chicks', 'category' => 'Sneakers', 'description' => 'Sneaker Khusus Untukmu Girls', 'price' => 350000, 'sizes' => null, 'image' => '1766384010_p1.jpeg'],
            ['name' => 'Strideelle Flat Shoes', 'slug' => 'strideelle-flat-shoes', 'category' => 'flatshoes', 'description' => null, 'price' => 140000, 'sizes' => null, 'image' => '1766384217_Discover the essence of elegance and authenticity….jpeg'],
            ['name' => 'heels', 'slug' => 'heels', 'category' => 'Wedding Heels', 'description' => null, 'price' => 400000, 'sizes' => null, 'image' => '1766387295_p4.jpeg'],
            ['name' => 'Cream Shoes', 'slug' => 'cream-shoes', 'category' => 'flatshoes', 'description' => null, 'price' => 100000, 'sizes' => null, 'image' => '1766906585_p3.jpeg'],
            ['name' => 'white cream Strideelle', 'slug' => 'white-cream-strideelle', 'category' => 'Sneakers', 'description' => null, 'price' => 230000, 'sizes' => null, 'image' => '1766910746_Fresh Foam Roav, WROAVRW.jpeg'],
            ['name' => 'Black Shoes', 'slug' => 'black-shoes', 'category' => 'flatshoes', 'description' => null, 'price' => 100000, 'sizes' => null, 'image' => '1766910879_Women\'s fantofel heels with an edgy model….jpeg'],
            ['name' => 'Strideelle Grey Shoes', 'slug' => 'strideelle-grey-shoes', 'category' => 'flatshoes', 'description' => null, 'price' => 220000, 'sizes' => null, 'image' => '1766910982_Fashion Women\'s Sweet Bowkont Point Toe Flat Slip….jpeg'],
            ['name' => 'White Black Strideelle Flat', 'slug' => 'white-black-strideelle-flat', 'category' => 'flatshoes', 'description' => null, 'price' => 88000, 'sizes' => null, 'image' => '1766911097_8b3838ab-2ebb-415e-b54c-62fb5c4198e1.jpeg'],
            ['name' => 'wedding Heels brukat', 'slug' => 'wedding-heels-brukat', 'category' => 'Wedding Heels', 'description' => null, 'price' => 350000, 'sizes' => null, 'image' => '1766911931_Transform your bridal look with our VEYL….jpeg'],
            ['name' => 'Red Heels', 'slug' => 'red-heels', 'category' => 'Heels', 'description' => null, 'price' => 223000, 'sizes' => null, 'image' => '1766912006_b21b6b73-e388-4100-80d2-336b8d4d050c.jpeg'],
            ['name' => 'Wedding Heels Strip', 'slug' => 'wedding-heels-strip', 'category' => 'Wedding Heels', 'description' => null, 'price' => 450000, 'sizes' => null, 'image' => '1766912071_c4a36b9d-93bd-4ffe-a06a-e170ad86e722.jpeg'],
            ['name' => 'Pink Black Shoes', 'slug' => 'pink-black-shoes', 'category' => 'Sneakers', 'description' => null, 'price' => 330000, 'sizes' => null, 'image' => '1766912417_6dc4f00f-d2ca-4fa6-a381-085d22dcd0e8.jpeg'],
            ['name' => 'Yellow flatshoes S', 'slug' => 'yellow-flatshoes-s', 'category' => 'flatshoes', 'description' => null, 'price' => 54000, 'sizes' => null, 'image' => '1766912476_9a7ef14c-e492-4960-b01d-da524d927d8b.jpeg'],
            ['name' => 'White Heels 5 cm', 'slug' => 'white-heels-5-cm', 'category' => 'Heels', 'description' => null, 'price' => 120000, 'sizes' => null, 'image' => '1766913633_Description__x__SPECIFICATIONS__SDWK Square Toe….jpeg'],
            ['name' => 'Chocolate Cream Strideelle', 'slug' => 'chocolate-cream-strideelle', 'category' => 'Wedding Heels', 'description' => null, 'price' => 300000, 'sizes' => null, 'image' => '1766913796_p2.jpeg'],
            ['name' => 'Sneakers White Black', 'slug' => 'sneakers-white-black', 'category' => 'Sneakers', 'description' => null, 'price' => 220000, 'sizes' => null, 'image' => '1766913856_2024 Sneakers Mesh Breathable Shoes  Women Men….jpeg'],
            ['name' => 'Sport Shoes', 'slug' => 'sport-shoes', 'category' => 'Sneakers', 'description' => null, 'price' => 120000, 'sizes' => null, 'image' => '1766914016_These low top sneakers by New Balance are designed….jpeg'],
            ['name' => 'Long Black Boots', 'slug' => 'long-black-boots', 'category' => 'Boots', 'description' => null, 'price' => 630000, 'sizes' => null, 'image' => '1766914622_85f30fa7-6b4e-43d8-bd40-f85e594746c9.jpeg'],
            ['name' => 'short black boot strideelee', 'slug' => 'short-black-boot-strideelee', 'category' => 'Boots', 'description' => null, 'price' => 320000, 'sizes' => null, 'image' => '1767407109_b1.jpeg'],
            ['name' => 'Strideelle Brown sugar', 'slug' => 'strideelle-brown-sugar', 'category' => 'Heels', 'description' => null, 'price' => 300000, 'sizes' => null, 'image' => '1767447045_d1cf36b7-8d18-4f22-95d8-25ac49b7450b.jpeg'],
            ['name' => 'White Flat Strideelle', 'slug' => 'white-flat-strideelle', 'category' => 'flatshoes', 'description' => null, 'price' => 100000, 'sizes' => null, 'image' => '1767447247_Women\'s Loafers Flat Shoes_High Quality Design….jpeg'],
            ['name' => 'strideelle orange juice', 'slug' => 'strideelle-orange-juice', 'category' => 'Heels', 'description' => null, 'price' => 222000, 'sizes' => null, 'image' => '1767447389_edb33c85-2a75-4209-99da-ea6ca5d2cd14.jpeg'],
            ['name' => 'strideelle wedding cream', 'slug' => 'strideelle-wedding-cream', 'category' => 'Wedding Heels', 'description' => null, 'price' => 670000, 'sizes' => null, 'image' => '1767447471_c4a36b9d-93bd-4ffe-a06a-e170ad86e722.jpeg'],
            ['name' => 'Rose  Gold Wedding Strideelle', 'slug' => 'rose-gold-wedding-strideelle', 'category' => 'Wedding Heels', 'description' => null, 'price' => 700000, 'sizes' => null, 'image' => '1767447583_p2.jpeg'],
        ];

        foreach ($products as $productData) {
            $category = Category::where('slug', Str::slug($productData['category'], '-'))->first();
            
            if ($category) {
                Product::firstOrCreate(
                    ['slug' => $productData['slug']],
                    [
                        'name' => $productData['name'],
                        'category_id' => $category->id,
                        'description' => $productData['description'],
                        'price' => $productData['price'],
                        'sizes' => $productData['sizes'],
                        'image' => $productData['image'],
                    ]
                );
            }
        }
    }
}

