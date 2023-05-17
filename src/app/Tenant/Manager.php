<?php

namespace App\Tenant;

class Manager
{
    public function isManager(): bool
    {
        return isset(auth()->user()->tenant->manager) ? auth()->user()->tenant->manager : true;
    }
}
