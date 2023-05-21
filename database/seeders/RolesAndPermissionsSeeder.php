<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Rol de admin
        $adminRole = Role::create(['name' => 'admin']);
        
        $createUsersPermission = Permission::create(['name' => 'create users']);
        $editUsersPermission = Permission::create(['name' => 'edit users']);
        $deleteUsersPermission = Permission::create(['name' => 'delete users']);
        
        $adminRole->givePermissionTo($createUsersPermission, $editUsersPermission, $deleteUsersPermission);
        
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@uvm.unah.edu.hn',
            'password' => Hash::make('Admin123'),
            'role' => 'admin'
        ]);

        $admin->assignRole($adminRole);

        // Rol de usuario (testing state)
        $userRole = Role::create(['name' => 'user']);

        $viewDashboardPermission = Permission::create(['name' => 'view dashboard']);
        
        $userRole->givePermissionTo($viewDashboardPermission);

        $user1 = User::create([
            'name' => 'User',
            'email' => 'user@unah.hn',
            'password' => Hash::make('User123'),
            'role' => 'user'
        ]);
    }
}
