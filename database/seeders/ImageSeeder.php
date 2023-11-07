<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::truncate();

        $products = Product::all();
        foreach($products as $product)
        {
            $numImages = rand(2, 5);

            // Create the images, but ensure that they are linked to the
            // current product
            Image::factory($numImages)->create([
                'product_id' => $product->id
            ]);

            // use the relationship function to create one or more ($numImages?)
            // related image objects - for the 'url' prop, either: 
            // a. Hard code a URL
            // b. Use: fake()->imageUrl()
            // NB - don't use a factory!
        }
    }
}
