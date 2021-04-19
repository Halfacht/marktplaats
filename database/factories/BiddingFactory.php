<?php

namespace Database\Factories;

use App\Models\Advertisement;
use App\Models\Bidding;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BiddingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bidding::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(1, 500),
            'user_id' => User::inRandomOrder()->first()->id,
            'advertisement_id' => Advertisement::inRandomOrder()->first()->id,
        ];
    }
}
