<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    protected $model = News::class;

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
            //'image' => 'news/' . $this->faker->image('storage/app/public/news', 800, 600, null, false),
            'image' => 'news/image.png',
            'is_published' => $this->faker->boolean(),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (News $news) {
            $categories = NewsCategory::inRandomOrder()->take(rand(1, 3))->get();
            $news->categories()->attach($categories);
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
