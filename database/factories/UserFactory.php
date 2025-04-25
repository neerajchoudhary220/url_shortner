<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??'password',
            'remember_token' => Str::random(10),
            'company_id'=>Company::factory()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    public function withRole(string $roleName): static
    {
        return $this->afterCreating(
            function (User $user) use ($roleName) {
                $role = Role::firstOrCreate(['name' => $roleName]);
                $user->assignRole($role);
            }
        );
    }
    public function withShortUrls(int $count = 100): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            $remaining = $count;
            while ($remaining > 0) {
                $createCount = min(100, $remaining);
                ShortUrl::factory($createCount)
                    ->for($user)
                    ->for($user->company)
                    ->create();
                $remaining -= $createCount;
            }
        });
    }

}
