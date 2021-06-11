<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(AuthRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email')
        ]);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken,
        ], 'регистрация успешна');
    }

    public function login(AuthLoginRequest $request)
    {
        if (!Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])) {
            return $this->error('Комбинация email - password в базе не найдена', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ], 'вход выполнен');
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return $this->success(null, 'выход выполнен');
    }
}
