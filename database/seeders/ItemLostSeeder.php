<?php

namespace Database\Seeders;

use App\Models\ItemLost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemLostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Empty the table first
        ItemLost::truncate();
    }
}
