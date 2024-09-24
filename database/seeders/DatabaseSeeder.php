<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            OfferSeeder::class,
            OfferSubscriptionSeeder::class,
            ClickSeeder::class,
            SiteIncomeSeeder::class
        ]);
    }
}
