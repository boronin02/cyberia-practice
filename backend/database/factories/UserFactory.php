<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
final class UserFactory extends Factory
{
    /**
     * @var string
     */
    public const DEFAULT_EMAIL = 'admin@admin.com';

    /**
     * @var string
     */
    public const DEFAULT_PASSWORD = 'password';

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make(self::DEFAULT_PASSWORD),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): self
    {
        return $this->state(function (): array {
            return [
                'name' => 'Администратор',
                'email' => self::DEFAULT_EMAIL,
                'password' => Hash::make(self::DEFAULT_PASSWORD),
            ];
        });
    }
}
