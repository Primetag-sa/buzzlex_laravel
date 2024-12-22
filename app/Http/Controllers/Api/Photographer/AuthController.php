<?php

namespace App\Http\Controllers\Api\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\Photographer\InformationRequest;
use App\Http\Requests\Photographer\LoginRequest;
use App\Http\Requests\Photographer\ProfileRequest;
use App\Http\Requests\Photographer\RegisterRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Resources\Photographer\ProfileResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\TokenResource;
use App\Models\Photographer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = Photographer::create($request->validated());
        $token = $user->createToken('api');
        return new SuccessResource([
            'token' => new TokenResource($token),
        ]);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $user = Photographer::query()
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

    public function verifyOtp(OtpRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        if($user->otp != $data['otp']){
            return response()->json(['message' => 'Invalid OTP'], 401);
        }
        $data['phone_verified_at'] = Carbon::now();
        $user->update($data);
        return new SuccessResource([], 'Phone verified successfully');
    }

    public function profile()
    {
        $user = auth()->user();
        return new ProfileResource($user);
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $user->update($data);
        return new ProfileResource($user);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);
        return new SuccessResource([], 'Password Changed Successfully');
    }

    public function updateInformation(InformationRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $user->update($data);
        $user->services()->delete();
        $user->services()->createMany(Arr::get($data, 'services', []));
        return new SuccessResource([], 'Data Updated Successfully');
    }
}
