<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>User::factory(),
            'image' =>'Фото чека',
            'prize' =>$this->faker->numberBetween(0,1),
            'code' =>$this->faker->unique()->regexify('[A-Za-z0-9]{8}'),
            'status' =>$this->faker->numberBetween(0,1),
            'created_at'=>$this->faker->dateTimeBetween($startDate = '-15 days', $endDate = 'now', $timezone = null),
            'updated_at'=>$this->faker->dateTimeBetween($startDate = '-15 days', $endDate = 'now', $timezone = null)
        ];
    }
}
