<?php

namespace App\DTO\Knowledge;

class KnowledgeCategoryDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description
        ];
    }
} 