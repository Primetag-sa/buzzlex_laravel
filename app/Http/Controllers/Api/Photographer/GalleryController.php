<?php

namespace App\Http\Controllers\Api\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photographer\GalleryRequest;
use App\Http\Resources\Photographer\GalleryResource;
use App\Http\Resources\SuccessResource;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $galleries = $user->galleries;
        return GalleryResource::collection($galleries);
    }

    public function show(Gallery $gallery)
    {
        return new GalleryResource($gallery);
    }

    public function store(GalleryRequest $request)
    {
        $user = auth()->user();
        $gallery = $user->galleries()->create([
            'service_id' => $request->service_id
        ]);
        foreach ($request->images as $image) {
            $gallery->addMedia($image)->toMediaCollection('gallery');
        }
        return new SuccessResource([],"Gallery Stored Successfully");
    }

    public function update(Gallery $gallery, GalleryRequest $request)
    {
        $gallery->update([
            'service_id' => $request->service_id
        ]);

        foreach ($request->images as $image) {
            $gallery->addMedia($image)->toMediaCollection('gallery');
        }
        return new SuccessResource([],"Gallery Stored Successfully");
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->clearMediaCollection('gallery');
        $gallery->delete();
        return new SuccessResource([],"Gallery Deleted Successfully");
    }
}
