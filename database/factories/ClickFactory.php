<?php

namespace Database\Factories;

use App\Models\Click;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Click>
 */
class ClickFactory extends Factory
{
    public function definition(): array
    {
        return [
            'offer_id' => Offer::factory()->create()->id,
            'webmaster_id' => User::factory()->state(['role' => 'webmaster'])->create()->id,
            'client_ip' => $this->faker->ipv4,
            'clicked_at' => $this->faker->dateTimeBetween('-1 year'),
        ];
    }
}
