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
        $categories = KnowledgeCategory::factory()->count(5)->create();

        // Создаем статьи
        $knowledge = Knowledge::factory()->count(20)->create();

        // Привязываем категории к статьям
        foreach ($knowledge as $item) {
            $item->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
