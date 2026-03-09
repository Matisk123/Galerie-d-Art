<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Kohn Matis',
            'email' => 'kohnmatistravail@gmail.com',
            'password' => Hash::make('password')
        ]);

        $role = Role::where('name','super_admin')->first();

        $user->roles()->attach($role);
    }
}
