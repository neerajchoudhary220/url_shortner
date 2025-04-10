<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $roles =[
                [
                    'name'=>'SuperAdmin',
                ],
                [
                    'name'=>'Admin'
                ],
                [
                    'name'=>'Member'
                ]
                ];
    
                foreach($roles as $role){
                    Role::updateOrCreate(['name'=>$role['name']],$role);
                }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error($e);
        }
       
    }
}
