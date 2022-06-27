<?php

namespace App\Admin\View\Composers;

use Illuminate\View\View;
use App\Models\InfoCompany;

class NotificationComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies are automatically resolved by the service container...
        
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $notify = auth()->guard('admin')->user()->notifications()->whereMonth('created_at', now()->month)->orderBy('created_at', 'desc')->get();
        // dd($notify[0]->data['notify']);
        $view->with(['notify' => $notify]);
    }
}