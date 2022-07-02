<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id'   => fake()->numberBetween(1,2),
            'start'         => now()->format('Y-m-d'),
            'end'           => now()->addMonths(1)->format('Y-m-d'),
        ];
    }
}
