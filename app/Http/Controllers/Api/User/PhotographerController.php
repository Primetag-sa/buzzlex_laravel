<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\PhotographerResource;
use App\Models\Photographer;
use Illuminate\Http\Request;

class PhotographerController extends Controller
{
    public function index(Request $request)
    {
        $photographers = Photographer::filter($request->only([
            'name',
            'email',
            'phone',
            'city',
            'gender',
            'rate'
        ]))->paginate($request->get('per_page', 10));

        return PhotographerResource::collection($photographers);
    }

    public function show(Photographer $photographer)
    {
        return new PhotographerResource($photographer);
    }
}
