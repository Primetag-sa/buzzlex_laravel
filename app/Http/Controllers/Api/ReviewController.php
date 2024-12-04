<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\SuccessResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        $user = auth()->user();
        $user->reviews()->create($request->validated());
        return new SuccessResource([], "Review Stored Successfully");
    }

    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    public function index(Request $request)
    {
        $reviews = Review::filter($request->only([
            'user',
            'photographer',
            'rate'
        ]))->paginate($request->get('per_page', 10));
        return ReviewResource::collection($reviews);
    }
}
