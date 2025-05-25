<?php

namespace Database\Seeders;

use App\Models\University;
use App\Models\UniversityFaculty;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    public function run(): void
    {
        // Создаем факультеты
        $faculties = UniversityFaculty::factory()->count(10)->create();

        // Создаем университеты
        $universities = University::factory()->count(5)->create();

        // Привязываем факультеты к университетам
        foreach ($universities as $university) {
            $university->faculties()->attach(
                $faculties->random(rand(3, 5))->pluck('id')->toArray()
            );
        }
    }
} 