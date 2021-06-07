<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

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
            'nameArticle'=> $this->faker->name,
            'priceArticle'=> $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 200, $max = 15000),
            'stockMinArticle'=> $this->faker->numberBetween($min = 1, $max = 1000),
            'stockMaxArticle'=> $this->faker->numberBetween($min = 1000, $max = 5000),
            'dateExpirationArt' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+30 years', $timezone = null),
            'category_id'=> $this->faker->numberBetween($min = 1, $max = 3)
        ];
    }
}
