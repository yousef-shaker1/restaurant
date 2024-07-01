<?php

namespace App\Observers;

use App\Models\User;
use App\Models\prodect;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;

class OrderObserver
{
    /**
     * Handle the prodect "created" event.
     */
    public function created(prodect $prodect): void
    {
        $user = auth()->user();
        $users = User::where('id', '!=', $user)->get();
        $user_create = User::where('id', $user)->first();
        if ($users->isNotEmpty()) {
        Notification::send($users, new OrderNotification(
            $prodect->name,
            $prodect->id,
        ));
        }
    }

    /**
     * Handle the prodect "updated" event.
     */
    public function updated(prodect $prodect): void
    {
        //
    }

    /**
     * Handle the prodect "deleted" event.
     */
    public function deleted(prodect $prodect): void
    {
        //
    }

    /**
     * Handle the prodect "restored" event.
     */
    public function restored(prodect $prodect): void
    {
        //
    }

    /**
     * Handle the prodect "force deleted" event.
     */
    public function forceDeleted(prodect $prodect): void
    {
        //
    }
}
