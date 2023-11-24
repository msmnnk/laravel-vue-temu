<?php

namespace Database\Seeders;

use App\Models\Charity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Charity::create([
            'name' => 'Youth Cancer Trust',
            'description' => 'Get involved and make a difference',
            'website' => 'https://www.youthcancertrust.org',
            'donation_percentage' => 30
        ]);
    }
}
