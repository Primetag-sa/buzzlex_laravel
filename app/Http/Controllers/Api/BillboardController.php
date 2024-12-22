<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillboardResource;
use App\Models\Billboard;
use Illuminate\Http\Request;

class BillboardController extends Controller
{
    public function index()
    {
        return BillboardResource::collection(Billboard::get());
    }

    public function show(Billboard $billboard)
    {
        return new BillboardResource($billboard);
    }
}
