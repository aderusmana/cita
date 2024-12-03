<?php

namespace Database\Factories;

use App\Models\Idea\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Idea>
 */
class IdeaFactory extends Factory
{
    protected $model = Idea::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'user_id' => $this->faker->numberBetween(1, 4),
            'category_id' => $this->faker->numberBetween(1, 4),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => '<p>' . $this->faker->paragraph . '</p>',
            'status' => 'Published',
        ];
    }
}
