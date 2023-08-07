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
           'state' => fake()->randomElement([Task::stateTODO,Task::stateProgress]),
           'user_id' => User::find(1),
           'date_start' => '2023-08-12 12:56:00'
        ];
    }
}
