<?php

namespace App\Models\Concerns;

trait Unguarded
{
    public function initializeUnguarded(): void
    {
        self::$unguarded = true;
        $this->guarded = [];
    }
}
