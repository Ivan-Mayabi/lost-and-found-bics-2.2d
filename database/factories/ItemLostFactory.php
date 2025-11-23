<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemLost>
 */
class ItemLostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // This has been accomplished better in the seeder
            'item_id'=>random_int(0,50),
            'date_lost'=>fake()->date('Y-m-d'),
            'description'=>fake()->realText(10),
            'place_lost'=>fake()->streetName(),
            'image_url'=>fake()->imageUrl()            
        ];
    }

    public function taken(): static
    {
        return $this->state(fn (array $attributes) => [
            'taken'=>random_int(1,1),
            'date_taken'=>fake()->dateTime(),
            'user_taken_id'=>random_int(1,50)
        ]);
    }
}
