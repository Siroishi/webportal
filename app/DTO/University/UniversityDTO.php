<?php

namespace App\DTO\University;

use Spatie\LaravelData\Data;

class UniversityDTO extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public string $description,
        public string $address,
        public string $phone,
        public string $email,
        public string $website,
        public string $logo,
        public bool $is_active,
    ) {
    }
} 