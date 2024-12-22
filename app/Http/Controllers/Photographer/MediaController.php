<?php

namespace App\Http\Controllers\Photographer;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function destroy(Media $media)
    {
        \DB::statement('DELETE FROM media WHERE id = ?', [$media->id]);
        return new SuccessResource([], "Media Deleted Successfully");
    }
}
