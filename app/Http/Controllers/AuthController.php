<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function store(LoginRequest $request){
        if (!Auth::attempt($request->only('email','password'))) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')]
            ]);
        }

        $user =  User::where('email', $request['email'])->firstOrFail();

        $plainTextToken = $user->createToken(
            'access_token',
        )->plainTextToken;

        return response()->json([
            'access_token' => $plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function destroy(User $user){
        auth()->user()->tokens()->delete();
        return response()->json([
            "message" => "Cerro sesión con éxito",
        ]);
    }

}
