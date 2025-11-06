<?php

namespace Database\Seeders;

use App\Models\ItemClaimed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemClaimedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empty the table first
        ItemClaimed::truncate();
    }
}
