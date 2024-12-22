<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Photographer\PlanResource;
use App\Http\Resources\User\GalleryResource;
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
            'rate',
            'service'
        ]))->paginate($request->get('per_page', 10));

        return PhotographerResource::collection($photographers);
    }

    public function show(Photographer $photographer)
    {
        $photographer->load([
            'services',
            'reviews' => function($query){
                $query->latest()->limit(3);
            },
            'availability'
        ]);
        $photographer->loadCount([
            'reviews',
        ]);
        return new PhotographerResource($photographer);
    }

    public function galleries(Photographer $photographer)
    {
        $galleries = $photographer->galleries;
        return GalleryResource::collection($galleries);
    }

    public function plans(Photographer $photographer)
    {
        $plans = $photographer->plans;
        return PlanResource::collection($plans);
    }
}
