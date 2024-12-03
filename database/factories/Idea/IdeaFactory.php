<?php

namespace Database\Factories\Idea;

use App\Models\Idea\Idea;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class IdeaFactory extends Factory
{
    protected $model = Idea::class;

    public function definition()
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
