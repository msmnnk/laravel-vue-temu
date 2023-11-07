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
        $product->title = 'Heated blanket';
        $product->description = 'Great for the old and infirm.';
        $product->save();

        // 2. Use Model::create(...)
        Product::create([
            'title' => 'Pills box',
            'description' => 'Manage all your pills in this handy box'
        ]);

        // 3. Use a factory
        Product::factory(300)->create();

        Product::factory()->create([
            'title' => 'a'
        ]);
    }
}
