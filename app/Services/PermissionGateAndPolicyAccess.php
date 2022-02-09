<?php

namespace App\Services;

use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess {

    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
    }

    public function defineGateCategory()
    {
        Gate::define('category-read', [CategoryPolicy::class, 'view']);
        Gate::define('category-create', [CategoryPolicy::class, 'create']);
        Gate::define('category-update', [CategoryPolicy::class, 'update']);
        Gate::define('category-delete', [CategoryPolicy::class, 'delete']);
    }


}
