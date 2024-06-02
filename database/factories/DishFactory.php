<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $imagesUrl = [
                'images/restaurants/23.jpg',
                'images/restaurants/24.jpg',
                'images/restaurants/25.jpg',
                'images/restaurants/26.jpg',
                'images/restaurants/28.jpeg',
                'images/restaurants/29.jpg',
                'images/restaurants/30.jpg',
                'images/restaurants/31.jpeg',
                'images/restaurants/32.jpg',
                'images/restaurants/33.jpg',
                'images/restaurants/34.jpg',
                'images/restaurants/35.jpeg',
        ];
        $restaurantIds = Restaurant::pluck('id')->toArray();
        $categoriesIds = Category::pluck('id')->toArray();

        return [
            'restaurant_id' => $this->faker->randomElement($restaurantIds),
            'image_path' => $this->faker->randomElement($imagesUrl),
            'category_id' => $this->faker->randomElement($categoriesIds),
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(50, 600),
            'description' => $this->faker->sentence,
        ];
    }
}
