<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AccountSidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();
        $user->loadMissing(['profile', 'roles']);

        $view->with('user', $user);
    }
}
