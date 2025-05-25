<?php

namespace App\DTO\University;

use Spatie\LaravelData\Data;

class UniversityFacultyDTO extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public string $description,
        public bool $is_active,
    ) {
    }
} 