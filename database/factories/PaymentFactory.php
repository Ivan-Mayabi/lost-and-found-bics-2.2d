<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'method'=>fake()->randomElement(['Mpesa','Cash']),
            'amount'=>random_int(1000,1000),
            'verified'=>random_int(0,1),
            'payment_id_token'=>Str::random(32)
        ];
    }
}
