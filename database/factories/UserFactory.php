<?php

namespace Database\Factories;

use App\Utils\RoleUtil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => RoleUtil::USER,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model's role should be admin.
     *
     * @return static
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => RoleUtil::ADMIN,
            ];
        });
    }

    /**
     * Indicate that the model's role should be user.
     *
     * @return static
     */
    public function user()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => RoleUtil::USER,
            ];
        });
    }
}
