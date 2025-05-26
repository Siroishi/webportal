<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем админа
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Создаем роль админа
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Создаем разрешения
        $permissions = [
            // Новости
            'view_any_news',
            'view_news',
            'create_news',
            'update_news',
            'delete_news',
            'restore_news',
            'force_delete_news',

            // Категории новостей
            'view_any_news_categories',
            'view_news_categories',
            'create_news_categories',
            'update_news_categories',
            'delete_news_categories',
            'restore_news_categories',
            'force_delete_news_categories',

            // База знаний
            'view_any_knowledge',
            'view_knowledge',
            'create_knowledge',
            'update_knowledge',
            'delete_knowledge',
            'restore_knowledge',
            'force_delete_knowledge',

            // Категории базы знаний
            'view_any_knowledge_categories',
            'view_knowledge_categories',
            'create_knowledge_categories',
            'update_knowledge_categories',
            'delete_knowledge_categories',
            'restore_knowledge_categories',
            'force_delete_knowledge_categories',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Назначаем все разрешения роли админа
        $adminRole->syncPermissions($permissions);

        // Назначаем роль админа пользователю
        $admin->syncRoles(['admin']);
    }
}
