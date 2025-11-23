<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemClaimed>
 */
class ItemClaimedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_lost_id'=>random_int(1,100),
            'user_id'=>random_int(1,50),
            'verified'=>random_int(0,2),

        ];
    }
}
