<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offer>
 */
class OfferFactory extends Factory
{
    public function definition(): array
    {
        return [
            'advertiser_id' => User::factory()->create()->id,
            'name' => $this->faker->word,
            'cost_per_click' => $this->faker->randomFloat(2, 0.5, 5.0),
            'target_url' => $this->faker->url,
            'site_themes' => implode(', ', $this->faker->words()),
            'is_active' => $this->faker->boolean,
        ];
    }
}
