<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

class CheckListFactory extends Factory
{
    public function definition()
    {
        return [
           'item' => fake()->sentence(1),
           'completed' => fake()->randomElement([false, true]),
           'task_id' => Task::find(1),
        ];
    }
}
