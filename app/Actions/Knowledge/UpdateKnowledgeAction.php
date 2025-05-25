<?php

namespace App\Actions\Knowledge;

use App\DTO\Knowledge\KnowledgeDTO;
use App\Models\Knowledge;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateKnowledgeAction
{
    public function execute(Knowledge $knowledge, KnowledgeDTO $dto): Knowledge
    {
        $imagePath = $knowledge->image;
        if ($dto->image) {
            if ($knowledge->image) {
                Storage::disk('public')->delete($knowledge->image);
            }
            $imagePath = $dto->image->store('knowledge', 'public');
        }

        $knowledge->update([
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