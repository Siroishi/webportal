<?php

namespace App\Actions\Knowledge;

use App\DTO\Knowledge\KnowledgeDTO;
use App\Models\Knowledge;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateKnowledgeAction
{
    public function execute(KnowledgeDTO $dto): Knowledge
    {
        $imagePath = null;
        if ($dto->image) {
            $imagePath = $dto->image->store('knowledge', 'public');
        }

        $knowledge = Knowledge::create([
            'title' => $dto->title,
            'slug' => Str::slug($dto->title),
            'content' => $dto->content,
            'image' => $imagePath,
            'is_published' => $dto->is_published,
            'published_at' => $dto->published_at
        ]);

        if ($dto->categories) {
            $knowledge->categories()->sync($dto->categories);
        }

        return $knowledge->load('categories');
    }
} 