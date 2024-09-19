<?php

namespace Database\Seeders;

use App\Models\Click;
use Illuminate\Database\Seeder;

class ClickSeeder extends Seeder
{
    public function run(): void
    {
        Click::factory(10)->create();
    }
}
