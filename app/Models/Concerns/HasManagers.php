<?php

namespace App\Models\Concerns;

use App\Models\Manager;

trait HasManagers
{
    public function managers()
    {
        return $this->belongsToMany(Manager::class);
    }

    public function currentManagers(): void
    {
    }

    public function previousManagers(): void
    {
    }
}
