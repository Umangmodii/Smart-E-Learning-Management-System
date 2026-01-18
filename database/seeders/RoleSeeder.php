<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Multiple Value 
        $roles = [
            'super_admin',
            'instructor',
            'student',
            'moderator',
            'affiliate',
            'corporate_admin',
        ];

        // Check at one time exist user another not 
        foreach($roles as $role){
            Role::firstOrCreate(['name'=>$role]);
        }
    }
}
