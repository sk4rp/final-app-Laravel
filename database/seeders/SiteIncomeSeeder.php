<?php

namespace Database\Seeders;

use App\Models\SiteIncome;
use Illuminate\Database\Seeder;

class SiteIncomeSeeder extends Seeder
{
    public function run(): void
    {
        SiteIncome::factory(10)->create();
    }
}
