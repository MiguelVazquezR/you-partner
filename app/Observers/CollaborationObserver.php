<?php

namespace App\Observers;

use App\Models\Collaboration;

class CollaborationObserver
{
    /**
     * Handle the Collaboration "created" event.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return void
     */
    public function created(Collaboration $collaboration)
    {
        //
    }

    public function creating(Collaboration $collaboration)
    {
        $collaboration->user_id = auth()->id();
        $collaboration->tax = auth()->user()->level->tax;
    }

    /**
     * Handle the Collaboration "updated" event.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return void
     */
    public function updated(Collaboration $collaboration)
    {
        //
    }

    /**
     * Handle the Collaboration "deleted" event.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return void
     */
    public function deleted(Collaboration $collaboration)
    {
        //
    }

    /**
     * Handle the Collaboration "restored" event.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return void
     */
    public function restored(Collaboration $collaboration)
    {
        //
    }

    /**
     * Handle the Collaboration "force deleted" event.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return void
     */
    public function forceDeleted(Collaboration $collaboration)
    {
        //
    }
}
