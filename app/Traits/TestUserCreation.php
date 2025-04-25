<?php
namespace App\Traits;

use App\Models\User;

trait TestUserCreation{
    public function CreateTestUserWithRole(string $roleName):User{
        return User::factory()->withRole($roleName)->create();
    }
}
