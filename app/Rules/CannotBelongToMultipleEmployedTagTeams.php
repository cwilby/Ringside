<?php

namespace App\Rules;

use App\Models\TagTeam;
use App\Models\Wrestler;
use Illuminate\Contracts\Validation\Rule;

class CannotBelongToMultipleEmployedTagTeams implements Rule
{
    /**
     * @var \App\Models\Wrestler
     */
    private $wrestler;

    /**
     * @var \App\Models\TagTeam|null
     */
    private $tagTeam;

    /**
     * @param \App\Models\TagTeam|null $tagTeam
     */
    public function __construct(TagTeam $tagTeam = null)
    {
        $this->tagTeam = $tagTeam;
    }

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

        if ($this->wrestler->currentTagTeam?->doesntExist()) {
            return true;
        }

        if ($this->wrestler->currentTagTeam?->is($this->tagTeam)) {
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
        return $this->wrestler->name.' is already a part of a current tag team.';
    }
}
