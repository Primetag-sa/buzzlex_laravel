<?php

namespace App\Http\Controllers\Api\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photographer\ForgotPassword;
use App\Http\Requests\Photographer\ResetPassword;
use App\Http\Resources\SuccessResource;
use App\Models\Photographer;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function forgot(ForgotPassword $request)
    {
        $user = Photographer::where('phone', $request->phone)->first();
        $user->otp = rand(1000, 9999);
        $user->save();
        return new SuccessResource([],'OTP sent successfully');
    }

    public function reset(ResetPassword $request)
    {
        $user = Photographer::where('phone', $request->phone)->first();
        if ($user->otp == $request->otp) {
            $user->password = bcrypt($request->password);
            $user->save();
            return new SuccessResource([],'Password reset successfully');
        } else {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }
    }
}
