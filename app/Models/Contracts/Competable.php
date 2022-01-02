<?php

namespace App\Models\Contracts;

interface Competable
{
    /**
     * Check to see if the model can be competed for.
     *
     * @return bool
     */
    public function isCompetable();
}
