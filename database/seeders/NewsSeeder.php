<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем категории
        NewsCategory::factory()->count(5)->create();

        // Создаем новости
        News::factory()->count(20)->create();
    }
}
