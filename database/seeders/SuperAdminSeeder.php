<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            
        $super_admin_data = [
            'name'=>'Test Super Admin',
            'email'=>'superadmin@gmail.com',
            'password'=>123456789 //passwrod will be convert to hash using by casting inside the user's model
        ];

        $superAdmin = User::updateOrCreate(
            ['email' => $super_admin_data['email']],
            $super_admin_data
        );
        
       $superAdmin->assignRole('SuperAdmin');

        } catch (\Exception $e) {
            logger()->error($e);
        }
    }
}
