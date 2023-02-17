<?php

namespace Database\Factories;

use App\Models\Transcation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranscationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transcation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by' => $this->faker->randomDigitNotNull,
        'type' => $this->faker->word,
        'amount' => $this->faker->randomDigitNotNull,
        'account_id' => $this->faker->randomDigitNotNull,
        'category_id' => $this->faker->randomDigitNotNull,
        'mode_id' => $this->faker->randomDigitNotNull,
        'date_time' => $this->faker->word,
        'description' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
