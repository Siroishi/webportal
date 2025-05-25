<?php

namespace App\Factory;

use App\Models\Knowledge;
use App\Models\KnowledgeCategory;

class KnowledgeFactory extends AbstractContentFactory
{
    public function create(array $data): array
    {
        $preparedData = $this->prepareData($data);
        $knowledge = Knowledge::create($preparedData);

        if (isset($data['categories'])) {
            $categoryIds = collect($data['categories'])->map(function ($category) {
                return KnowledgeCategory::firstOrCreate(
                    ['slug' => \Str::slug($category)],
                    ['name' => $category]
                )->id;
            });

            $knowledge->categories()->sync($categoryIds);
        }

        return $knowledge->toArray();
    }
} 