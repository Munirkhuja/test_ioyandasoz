<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model =Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'driver_id' => $this->faker->randomElement(Driver::pluck('user_id')->all()),
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
            'status' => $this->faker->randomElement([
                Order::STATUS_ENTRY,
                Order::STATUS_DRIVER_ASSIGNED,
                Order::STATUS_DRIVER_IN_SPOT,
                Order::STATUS_EXECUTED,
                Order::STATUS_COMPETED
            ]),
            'amount' => rand(10,1000)*100,
        ];
    }
}
