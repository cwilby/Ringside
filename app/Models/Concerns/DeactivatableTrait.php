<?php

namespace App\Models\Concerns;

trait DeactivatableTrait
{
    /**
     * Check to see if the model is deactivated.
     *
     * @return bool
     */
    public function isDeactivated()
    {
        return $this->previousActivation()->exists() &&
                $this->currentActivation()->doesntExist() &&
                $this->futureActivation()->doesntExist() &&
                $this->currentRetirement()->doesntExist();
    }

    /**
     * Determine if the model can be deactivated.
     *
     * @return bool
     */
    public function canBeDeactivated()
    {
        if ($this->isCurrentlyActivated()) {
            return true;
        }

        return false;
    }
}
