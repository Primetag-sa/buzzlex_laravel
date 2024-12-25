<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillboardResource;
use App\Http\Resources\SuccessResource;
use App\Models\Billboard;
use Illuminate\Http\Request;

class BillboardController extends Controller
{
    public function index()
    {
        $appBillboards = Billboard::where('type', Billboard::APP_TYPE)->get();
        $userBillboards = Billboard::where('type', Billboard::USER_TYPE)->get();
        $result = [
            'app_billboards' => BillboardResource::collection($appBillboards),
            'user_billboards' => BillboardResource::collection($userBillboards),
        ];
        return new SuccessResource($result);
    }

    public function show(Billboard $billboard)
    {
        return new BillboardResource($billboard);
    }
}
