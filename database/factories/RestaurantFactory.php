<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagesUrl = [
            'images/restaurants/1.jpeg',
            'images/restaurants/2.jpg',
            'images/restaurants/3.jpg',
            'images/restaurants/4.jpg',
            'images/restaurants/5.jpg',
            'images/restaurants/6.jpg',
            'images/restaurants/7.jpeg',
            'images/restaurants/8.jpg',
            'images/restaurants/9.jpg',
            'images/restaurants/10.jpg',
            'images/restaurants/11.jpeg',
            'images/restaurants/12.jpeg',
            'images/restaurants/12.jpg',
            'images/restaurants/15.jpg',
        ];

        $addressArr = [
            'вулиця Галицька, 34А, Івано-Франківськ, Івано-Франківська область, Украина, 76000',
            'вулиця Галицька, 32, Івано-Франківськ, Івано-Франківська область, Украина, 76000',
            'вулиця Івана Франка, 48, Івано-Франківськ, Івано-Франківська область, Украина, 76000',
            "134A, вулиця В'ячеслава Чорновола, 134А, Івано-Франківськ, Івано-Франківська область, Украина, 76000",
            'вулиця Галицька, 123, Отинія, Івано-Франківська область, Украина, 78224',
            'вулиця Гетьмана Дорошенка, 22б, Івано-Франківськ, Івано-Франківська область, Украина, 76026',
            'вулиця Січових стрільців, 42А, Івано-Франківськ, Івано-Франківська область, Украина, 76000',
            'проспект Михайла Грушевського, 88, Коломия, Івано-Франківська область, Украина, 78200',
            'вулиця Слобідська, 2, Івано-Франківськ, Івано-Франківська область, Украина, 76000',
            'вулиця Тисменицька, 249б, Угорники, Івано-Франківська область, Украина, 76492',
            'вулиця Євгена Коновальця, 221, Івано-Франківськ, Івано-Франківська область, Украина, 76000',
        ];

        return [
            'name' => $this->faker->company,
            'address' => $this->faker->randomElement($addressArr),
            'image_path' => $this->faker->randomElement($imagesUrl),
            'phone' => $this->faker->unique()->phoneNumber,
            'user_id' => 2,
        ];
    }
}
