<?php

namespace App\Factory;

use App\Contracts\Factory\ContentFactoryInterface;

abstract class AbstractContentFactory implements ContentFactoryInterface
{
    protected function prepareData(array $data): array
    {
        return array_merge($data, [
            'slug' => \Str::slug($data['title']),
            'is_published' => $data['is_published'] ?? false,
            'published_at' => $data['published_at'] ?? null,
        ]);
    }

    public function createMany(array $items): array
    {
        return array_map(fn($item) => $this->create($item), $items);
    }
} 