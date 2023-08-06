<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function show(User $user){
        return response()->json([
            "data"=> [
                'name' => $user->name,
                'email' => $user->email
            ],
            "include" => $user->tasks
        ]);
    }
}
