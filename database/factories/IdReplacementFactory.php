<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IdReplacement>
 */
class IdReplacementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_lost'=>random_int(100000,999999),
            'payment_id'=>random_int(1,40),
            'user_id'=>random_int(1,50),
            'approved'=>random_int(0,1)
        ];
    }
}
