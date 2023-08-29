<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use App\Mail\AdminMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdmin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreated $event): void
    {
        $admin = User::first();
        \Mail::to($admin->email)->send(new AdminMail($event->company));
    }
}
