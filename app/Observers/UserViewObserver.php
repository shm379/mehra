<?php

namespace App\Observers;

use App\Models\UserView;

class UserViewObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the UserView "created" event.
     *
     * @param  \App\Models\UserView  $userView
     * @return void
     */
    public function created(UserView $userView)
    {
        dd($userView);
    }

    /**
     * Handle the UserView "updated" event.
     *
     * @param  \App\Models\UserView  $userView
     * @return void
     */
    public function updated(UserView $userView)
    {
        $userView->update(['count'=>$userView->count+1]);
    }

    /**
     * Handle the UserView "deleted" event.
     *
     * @param  \App\Models\UserView  $userView
     * @return void
     */
    public function deleted(UserView $userView)
    {
        //
    }

    /**
     * Handle the UserView "restored" event.
     *
     * @param  \App\Models\UserView  $userView
     * @return void
     */
    public function restored(UserView $userView)
    {
        //
    }

    /**
     * Handle the UserView "force deleted" event.
     *
     * @param  \App\Models\UserView  $userView
     * @return void
     */
    public function forceDeleted(UserView $userView)
    {
        //
    }
}
