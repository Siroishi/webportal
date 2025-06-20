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

        $admin = User::firstOrCreate(
            ['email' => 'OsadchukM@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );


        $adminRole = Role::firstOrCreate(['name' => 'admin']);


        $permissions = [

            'view_any_news',
            'view_news',
            'create_news',
            'update_news',
            'delete_news',
            'restore_news',
            'force_delete_news',


            'view_any_news_categories',
            'view_news_categories',
            'create_news_categories',
            'update_news_categories',
            'delete_news_categories',
            'restore_news_categories',
            'force_delete_news_categories',

            'view_any_knowledge',
            'view_knowledge',
            'create_knowledge',
            'update_knowledge',
            'delete_knowledge',
            'restore_knowledge',
            'force_delete_knowledge',

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


        $adminRole->syncPermissions($permissions);

        $admin->syncRoles(['admin']);
    }
}
