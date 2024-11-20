<?php

namespace App\Observers;

use App\Models\Photographer;
use Illuminate\Support\Facades\Hash;

class PhotographerObserver
{
    /**
     * Handle the Photographer "creating" event.
     */
    public function creating(Photographer $photographer): void
    {
        $photographer->password = Hash::make($photographer->password);
        $photographer->otp = mt_rand(1000, 9999);
    }

    /**
     * Handle the Photographer "created" event.
     */
    public function created(Photographer $photographer): void
    {
        //
    }

    /**
     * Handle the Photographer "updated" event.
     */
    public function updated(Photographer $photographer): void
    {
        //
    }

    /**
     * Handle the Photographer "deleted" event.
     */
    public function deleted(Photographer $photographer): void
    {
        //
    }

    /**
     * Handle the Photographer "restored" event.
     */
    public function restored(Photographer $photographer): void
    {
        //
    }

    /**
     * Handle the Photographer "force deleted" event.
     */
    public function forceDeleted(Photographer $photographer): void
    {
        //
    }
}
