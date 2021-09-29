<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            /* 'image' => 'articles/' . $this->faker->image('public/storage/articles', 640, 480, null, false), */
            'image' => 'articles/' . $this->faker->unique()->word(),
            'extract' => $this->faker->text(),
            'body' => $this->faker->text(2000)
        ];
    }
}
