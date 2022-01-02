<?php

namespace App\Rules;

use App\Models\Wrestler;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CannotBeEmployedAfterDate implements Rule
{
    /**
     * @var \App\Models\Wrestler
     */
    private $wrestler;

    /**
     * @var string|null
     */
    protected $startedAt;

    public function __construct(string $startedAt = null)
    {
        $this->startedAt = $startedAt;
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
        if ($this->startedAt === null) {
            return true;
        }

        $this->wrestler = Wrestler::findOrFail((int) $value);

        if ($this->wrestler->isUnemployed()) {
            return true;
        }

        if ($this->wrestler->isCurrentlyEmployed()) {
            if ($currentEmployment = $this->wrestler->currentEmployment) {
                return $currentEmployment->startedBefore(Carbon::parse($this->startedAt));
            }
        }

        if ($this->wrestler->hasFutureEmployment()) {
            if ($futureEmployment = $this->wrestler->futureEmployment) {
                return $futureEmployment->startedBefore(Carbon::parse($this->startedAt));
            }
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
        return $this->wrestler->name.' is not employed before '.$this->startedAt;
    }
}
