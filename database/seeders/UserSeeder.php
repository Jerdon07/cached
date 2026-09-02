<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'System Administrator',
                'email' => 'jdlitaoen+admin@gmail.com',
                'role' => 'System Administrator',
            ], [
                'name' => 'Purchasing Officer',
                'email' => 'jdlitaoen+pofficer@gmail.com',
                'role' => 'Purchasing Officer',
            ], [
                'name' => 'Purchasing Manager',
                'email' => 'jdlitaoen+pmanager@gmail.com',
                'role' => 'Purchasing Manager',
            ], [
                'name' => 'Warehouse Manager',
                'email' => 'jdlitaoen+wmanager@gmail.com',
                'role' => 'Warehouse Manager',
            ], [
                'name' => 'Warehouse Staff',
                'email' => 'jdlitaoen+wstaff@gmail.com',
                'role' => 'Warehouse Staff',
            ], [
                'name' => 'Sales Representative',
                'email' => 'jdlitaoen+srepresentative@gmail.com',
                'role' => 'Sales Representative',
            ], [
                'name' => 'Sales Manager',
                'email' => 'jdlitaoen+smanager@gmail.com',
                'role' => 'Sales Manager',
            ], [
                'name' => 'Inventory Controller',
                'email' => 'jdlitaoen+icontroller@gmail.com',
                'role' => 'Inventory Controller',
            ], [
                'name' => 'Finance Officer',
                'email' => 'jdlitaoen+fofficer@gmail.com',
                'role' => 'Finance Officer',
            ], [
                'name' => 'General Manager',
                'email' => 'jdlitaoen+gmanager@gmail.com',
                'role' => 'General Manager',
            ],
        ];

        foreach ($users as $userData) {
            $role = Role::where('name', $userData['role'])->firstOrFail();

            $user = User::firstOrCreate(
                [
                    'email' => $userData['email'],
                ], [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                ]
            );

            $user->roles()->attach($role->id);
        }

        $roles = Role::all();

        User::factory(30)
            ->hasAttached($roles->random(3))
            ->create();
    }
}
