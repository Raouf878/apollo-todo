<?php

namespace Database\Factories;

use App\Models\todos;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodosFactory extends Factory
{
    // Specify the model the factory is for
    protected $model = todos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'work' => $this->faker->paragraph,
            'duedate' => $this->faker->date(),
            'user_id' => \App\Models\User::factory(), // Associate with a User
        ];
    }
}
