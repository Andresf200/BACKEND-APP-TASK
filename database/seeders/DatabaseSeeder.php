<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\CheckList;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         User::factory()->create([
            'email' => 'afloriangonzales@gmail.com',
         ]);

         Task::factory()->count(2)->create();
         CheckList::factory()->count(2)->create();
    }
}
