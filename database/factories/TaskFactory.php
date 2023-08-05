<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;

class TaskFactory extends Factory
{

    public function definition()
    {
        return [
           'title' => fake()->sentence(1),
           'description' => fake()->text(120),
           'state' => fake()->randomElement([Task::stateTODO,Task::stateProgress,Task::stateCompleted]),
           'user_id' => User::find(1),
           'date_start' => fake()->date(now())
        ];
    }
}
