<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

class TaskFactory extends Factory
{

    public function definition()
    {
        return [
           'title' => fake()->sentence(),
           'description' => fake()->text(),
           'state' => fake()->randomElements([Task::stateTODO,Task::stateProgress,Task::stateCompleted])
        ];
    }
}
