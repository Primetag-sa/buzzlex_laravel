<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\TokenResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('api');
        return new SuccessResource([
            'token' => new TokenResource($token),
        ]);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::query()
                    ->where('phone',$data['phone'])
                    ->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('web');
        } else {
            throw ValidationException::withMessages([
                'phone' => ['invalid credentials'],
            ]);
        }
        
        return [
            'user' => $user,
            'token' => new TokenResource($token)
        ];
    }
}
