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
            'name' => 'Lewys',
            'description' => 'Help the needy',
            'website' => 'www.lewys.com',
            'donation_percentage' => 10
        ]);
    }
}
