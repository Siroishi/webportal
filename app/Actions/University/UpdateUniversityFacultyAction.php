<?php

namespace App\Actions\University;

use App\DTO\University\UniversityFacultyDTO;
use App\Models\UniversityFaculty;
use Illuminate\Support\Str;

class UpdateUniversityFacultyAction
{
    public function execute(UniversityFaculty $faculty, UniversityFacultyDTO $dto): UniversityFaculty
    {
        $faculty->update([
            'name' => $dto->name,
            'slug' => Str::slug($dto->name),
            'description' => $dto->description,
            'is_active' => $dto->is_active,
        ]);

        return $faculty;
    }
} 