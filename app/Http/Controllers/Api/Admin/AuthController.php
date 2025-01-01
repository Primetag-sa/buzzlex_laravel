<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\TokenResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = Admin::query()
                    ->where('email',$data['email'])
                    ->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('dashboard');
        } else {
            throw ValidationException::withMessages([
                'email' => ['invalid credentials'],
            ]);
        }

        return new SuccessResource([
            'user' => $user,
            'token' => new TokenResource($token)
        ], "Logged in Successfully");
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? new SuccessResource([], "Reset link sent successfully")
                : response()->json(["message" => __($status)],400);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Admin $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                ? new SuccessResource([], "Password changed successfully")
                : response()->json(["message" => __($status)], 400);
    }
}
