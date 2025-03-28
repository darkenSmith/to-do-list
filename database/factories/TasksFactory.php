<?php

namespace Database\Factories;

use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public $model = Tasks::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'completed' => $this->faker->boolean(),
            'completed_at' => $this->faker->dateTime(),
        ];
    }
}
