<?php

namespace Database\Seeders;

use App\Models\University;
use App\Models\UniversityFaculty;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    public function run(): void
    {

        $faculties = UniversityFaculty::factory()->count(10)->create();


        $universities = University::factory()->count(5)->create();


        foreach ($universities as $university) {
            $university->faculties()->attach(
                $faculties->random(rand(3, 5))->pluck('id')->toArray()
            );
        }
    }
}
