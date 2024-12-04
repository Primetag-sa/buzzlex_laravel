<?php

namespace App\Observers;

use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        $newRate = Review::where('photographer_id', $review->photographer_id)->avg('rate');
        $review->photographer()->update([
            'rate' => round($newRate, 2)
        ]);
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        $newRate = Review::where('photographer_id', $review->photographer_id)->avg('rate');
        $review->photographer()->update([
            'rate' => round($newRate, 2)
        ]);
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        $newRate = Review::where('photographer_id', $review->photographer_id)->avg('rate');
        $review->photographer()->update([
            'rate' => round($newRate, 2)
        ]);
    }

    /**
     * Handle the Review "restored" event.
     */
    public function restored(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "force deleted" event.
     */
    public function forceDeleted(Review $review): void
    {
        //
    }
}
