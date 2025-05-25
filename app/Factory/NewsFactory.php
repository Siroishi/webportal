<?php

namespace App\Factory;

use App\Models\News;
use App\Models\NewsCategory;

class NewsFactory extends AbstractContentFactory
{
    public function create(array $data): array
    {
        $preparedData = $this->prepareData($data);
        $news = News::create($preparedData);

        if (isset($data['categories'])) {
            $categoryIds = collect($data['categories'])->map(function ($category) {
                return NewsCategory::firstOrCreate(
                    ['slug' => \Str::slug($category)],
                    ['name' => $category]
                )->id;
            });

            $news->categories()->sync($categoryIds);
        }

        return $news->toArray();
    }
} 