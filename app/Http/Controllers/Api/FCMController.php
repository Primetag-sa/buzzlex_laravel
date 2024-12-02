<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class FCMController extends Controller
{
    public function updateFcmToken()
    {
        $fcmToken = request()->input('fcm_token');
        $user = auth()->user();
        $user->fcm_token = $fcmToken;
        $user->save();
        return new SuccessResource([],"FCM Token updated successfully");
    }
}
