<?php

namespace App\Actions\University;

use App\DTO\University\UniversityFacultyDTO;
use App\Models\UniversityFaculty;
use Illuminate\Support\Str;

class StoreUniversityFacultyAction
{
    public function execute(UniversityFacultyDTO $dto): UniversityFaculty
    {
        return UniversityFaculty::create([
            'name' => $dto->name,
            'slug' => Str::slug($dto->name),
            'description' => $dto->description,
            'is_active' => $dto->is_active,
        ]);
    }
} 