<?php

namespace Database\Factories;

use App\Models\UniversityFaculty;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UniversityFacultyFactory extends Factory
{
    protected $model = UniversityFaculty::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true) . ' Faculty';
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(80),
        ];
    }

    public function active(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    public function inactive(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }
} 