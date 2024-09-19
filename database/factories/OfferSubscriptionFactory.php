<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\OfferSubscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OfferSubscription>
 */
class OfferSubscriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'webmaster_id' => User::factory()->state(['role' => 'webmaster'])->create()->id,
            'offer_id' => Offer::factory()->create()->id,
            'cost_per_click' => $this->faker->randomFloat(2, 0.5, 5.0),
        ];
    }
}
