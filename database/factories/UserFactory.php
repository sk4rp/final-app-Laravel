<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        $role = $this->faker->randomElement(['advertiser', 'webmaster', 'admin']);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $role === RoleEnum::admin->value ? Hash::make('admin_password') : Hash::make('user_password'),
            'role' => $this->faker->randomElement(['advertiser', 'webmaster', 'admin']),
            'balance' => $this->faker->randomFloat(100, 0, 10000)
        ];
    }
}
