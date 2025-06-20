<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем или создаем роль admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Создаем права
        $permissions = [
            'view news',
            'create news',
            'edit news',
            'delete news',
            'view news categories',
            'create news categories',
            'edit news categories',
            'delete news categories',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Назначаем все права роли admin
        $adminRole->givePermissionTo($permissions);

        // Назначаем роль admin первому пользователю
        $user = User::first();
        if ($user && !$user->hasRole('admin')) {
            $user->assignRole('admin');
        }
    }
} 
