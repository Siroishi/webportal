<?php

namespace Database\Seeders;

use App\Models\Knowledge;
use App\Models\KnowledgeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем категории
        KnowledgeCategory::factory()->count(5)->create();

        // Создаем статьи
        Knowledge::factory()->count(20)->create();
    }
}
