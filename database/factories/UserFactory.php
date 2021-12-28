<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $modelClass = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => Str::random(10),
            'role' => Role::basic(),
        ];
    }

    public function administrator(): self
    {
        return $this->state([
            'role' => Role::administrator(),
        ]);
    }

    public function basicUser(): self
    {
        return $this->state([
            'role' => Role::basic(),
        ]);
    }

    /**
     * Create a user with a specific role.
     *
     * @param  string $role
     * @return static
     */
    public function withRole(string $role): static
    {
        return $this->state([
            'role' => $role,
        ]);
    }
}
