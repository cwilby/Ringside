<?php

namespace App\Models\Contracts;

interface CanBeAStableMember
{
    /**
     * Get the stables the stable member has been a member of.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function stables();

    /**
     * Get the current stable the member belongs to.
     *
     * @return \Staudenmeir\EloquentHasManyDeep\HasOneDeep
     */
    public function currentStable();

    /**
     * Get the previous stables the member has belonged to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function previousStables();
}
