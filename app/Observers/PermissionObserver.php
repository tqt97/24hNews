<?php

namespace App\Observers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     *
     * @param  \App\Models\Permission  $permission
     * @return void
     */
    public function created(Permission $permission)
    {
        
    }

}
