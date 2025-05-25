<?php

namespace Database\Factories;

use App\Models\Knowledge;
use App\Models\KnowledgeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Knowledge>
 */
class KnowledgeFactory extends Factory
{
    protected $model = Knowledge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(3, true),
            'image' => 'knowledge/' . $this->faker->image('storage/app/public/knowledge', 800, 600, null, false),
            'is_published' => $this->faker->boolean(80),
            'published_at' => $this->faker->optional(0.7)->dateTimeThisMonth(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Knowledge $knowledge) {
            $categories = KnowledgeCategory::inRandomOrder()->take(rand(1, 3))->get();
            $knowledge->categories()->attach($categories);
        });
    }

    public function published(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => true,
                'published_at' => now(),
            ];
        });
    }

    public function unpublished(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => false,
                'published_at' => null,
            ];
        });
    }
}
