<?php

namespace App\Rules;

use App\Models\Wrestler;
use Illuminate\Contracts\Validation\Rule;

class CannotBeHindered implements Rule
{
    /**
     * @var \App\Models\Wrestler
     */
    private $wrestler;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  int  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->wrestler = Wrestler::findOrFail((int) $value);

        if ($this->wrestler->isUnemployed() || $this->wrestler->isBookable()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->wrestler->name.' is not allowed to join this tag team.';
    }
}
