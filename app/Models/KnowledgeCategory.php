<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KnowledgeCategory extends Model
{
    /** @use HasFactory<\Database\Factories\KnowledgeCategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function knowledge(): BelongsToMany
    {
        return $this->belongsToMany(Knowledge::class, 'knowledge_category_relations')
            ->withTimestamps();
    }
}
