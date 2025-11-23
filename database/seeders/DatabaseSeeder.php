<?php

namespace Database\Seeders;

use App\Models\IdReplacement;
use App\Models\Item;
use App\Models\ItemClaimed;
use App\Models\ItemLost;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->call([
            RoleSeeder::class,
            ItemSeeder::class,
            PaymentSeeder::class,
            ItemLostSeeder::class,
            UserSeeder::class,
            ItemClaimedSeeder::class,
            IdReplacementSeeder::class
        ]);
        User::factory(50)->create();
        ItemClaimed::factory(75)->create();
        Payment::factory(40)->create();
        IdReplacement::factory(40)->create();
        Schema::enableForeignKeyConstraints();       
        
    }
}
