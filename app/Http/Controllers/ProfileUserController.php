<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class ProfileUserController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $user = User::create($request->all());
        return response()->json([
            'status' => 200,
            'data' => $user,
            'message' => "Usuario Registado Con Exito!!!"
        ]);
    }
}
