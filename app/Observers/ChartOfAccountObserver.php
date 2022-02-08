<?php

namespace App\Observers;

use App\Models\ChartOfAccount;

class ChartOfAccountObserver
{
    /**
     * Handle the ChartOfAccount "created" event.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return void
     */
    public function created(ChartOfAccount $chartOfAccount)
    {
        $chartOfAccount = ChartOfAccount::where('id', $chartOfAccount->parent_id)
            ->orderby('id', 'desc')
            ->first();
        $chartOfAccount->update(['last_child' => false]);
    }

    /**
     * Handle the ChartOfAccount "updated" event.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return void
     */
    public function updated(ChartOfAccount $chartOfAccount)
    {
        //
    }

    /**
     * Handle the ChartOfAccount "deleted" event.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return void
     */
    public function deleted(ChartOfAccount $chartOfAccount)
    {
        //
    }

    /**
     * Handle the ChartOfAccount "restored" event.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return void
     */
    public function restored(ChartOfAccount $chartOfAccount)
    {
        //
    }

    /**
     * Handle the ChartOfAccount "force deleted" event.
     *
     * @param  \App\Models\ChartOfAccount  $chartOfAccount
     * @return void
     */
    public function forceDeleted(ChartOfAccount $chartOfAccount)
    {
        //
    }
}
