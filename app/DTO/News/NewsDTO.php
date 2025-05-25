<?php

namespace App\DTO\News;

use Illuminate\Http\UploadedFile;

class NewsDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly ?UploadedFile $image,
        public readonly bool $is_published,
        public readonly ?string $published_at,
        public readonly ?array $categories
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            title: $data['title'],
            content: $data['content'],
            image: $data['image'] ?? null,
            is_published: $data['is_published'] ?? false,
            published_at: $data['published_at'] ?? null,
            categories: $data['categories'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
            'categories' => $this->categories
        ];
    }
} 