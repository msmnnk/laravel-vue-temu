<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();

        // Create a new Product!
        // 1. Instantiate model
        $product = new Product();
        $product->title = 'Black Crop T-shirt';
        $product->description = 'Upgrade your casual day style with this cropped t-shirt, cut from soft, stretchy cotton fabric for total comfort.
        Care & Material: 61% Cotton/33% Polyester/6% Elastane.
        Colour: Black.';
        $product->category = 'Tops';
        $product->price = 40_00;
        $product->stock = 10;
        $product->save();

        // 2. Use Model::create(...)
        Product::create([
            'title' => 'High-Waisted Leggings',
            'description' => 'Make comfort top priority with these high waist leggings, cut from stretchy cotton fabric for unrestricted fit.
            Care & Material: 93% Cotton/7% Elastane.
            Colour: Grey.',
            'category' => 'Bottoms',
            'price' => 65_00,
            'stock' => 35
        ]);

        Product::create([
            'title' => 'White Thermal 500ml Bottle',
            'description' => 'Made with durable stainless steel, it uses thermal tech to keep your cold drinks cold, and hot drinks warm.
            Care & Material: Stainless Steel.
            Colour: Black.',
            'category' => 'Accessories',
            'price' => 20_00,
            'stock' => 2
        ]);

        // 3. Use a factory
        Product::factory(300)->create();

        // Product::factory()->create([
        //     'title' => 'a'
        // ]);
    }
}
