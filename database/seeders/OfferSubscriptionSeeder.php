<?php

namespace Database\Seeders;

use App\Models\OfferSubscription;
use Illuminate\Database\Seeder;

class OfferSubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        OfferSubscription::factory(10)->create();
    }
}
