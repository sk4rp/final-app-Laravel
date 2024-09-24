<?php

namespace Database\Factories;

use App\Models\SiteIncome;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SiteIncome>
 */
class SiteIncomeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'total_income' => $this->faker->numberBetween(100, 10000)
        ];
    }
}
