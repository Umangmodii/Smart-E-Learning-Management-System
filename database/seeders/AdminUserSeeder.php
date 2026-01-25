<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::where('name','super_admin')->first();

        if($superAdmin){
        User::updateOrCreate(
                ['email' => 'admin@smartlms.com'],
                [
                    'name' => 'Smart LMS',
                    'password' => Hash::make('admin@smartlms'),
                    'role_id' => $superAdmin->id,
                ]
        );
    }
  }
}
