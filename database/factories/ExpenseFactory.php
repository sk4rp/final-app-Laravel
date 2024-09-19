<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'offer_id' => Offer::factory()->create()->id,
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'date' => $this->faker->date,
        ];
    }
}
