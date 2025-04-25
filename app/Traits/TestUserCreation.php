<?php
namespace App\Traits;

use App\Models\User;

trait TestUserCreation{
    protected function createTestUserWithRole(string $role): User
    {
        return User::factory()
            ->withRole($role)
            ->when($role === 'SuperAdmin', fn ($factory) => $factory->state(['company_id' => null]))
            ->create();
    }
}
