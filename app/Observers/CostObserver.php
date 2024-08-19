<?php

namespace App\Observers;

use App\Models\Cost;
use Illuminate\Support\Facades\Log;

class CostObserver
{
    /**
     * Handle the Transaksi "created" event.
     */
    public function created(Cost $cost): void
    {
        $lastCost = Cost::orderBy('id_biaya', 'desc')->first();
        $nextId = $lastCost ? intval(substr($lastCost->id_biaya, 2)) + 1 : 1;
        $cost->id_biaya = 'C-' . $nextId;
    }

    /**
     * Handle the Transaksi "updated" event.
     */
    public function updated(Cost $Cost): void
    {
        //
    }

    /**
     * Handle the Cost "deleted" event.
     */
    public function deleted(Cost $Cost): void
    {
        //
    }

    /**
     * Handle the Cost "restored" event.
     */
    public function restored(Cost $Cost): void
    {
        //
    }

    /**
     * Handle the Transaksi "force deleted" event.
     */
    public function forceDeleted(Cost $cost): void
    {
        //
    }
}
