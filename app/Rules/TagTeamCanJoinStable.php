<?php

namespace App\Rules;

use App\Models\Stable;
use App\Models\TagTeam;
use Illuminate\Contracts\Validation\Rule;

class TagTeamCanJoinStable implements Rule
{
    /**
     * @var string
     */
    public $message = '';

    /**
     * @var \App\Models\Stable
     */
    protected $stable;

    /**
     * @var string|null
     */
    protected ?string $startedAt;

    /**
     * Create a new rule instance.
     *
     * @param \App\Models\Stable $stable
     * @param string|null $startedAt
     * @return void
     */
    public function __construct(Stable $stable, string $startedAt = null)
    {
        $this->stable = $stable;
        $this->startedAt = $startedAt;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tagTeam = TagTeam::with(['currentStable', 'futureEmployment'])->findOrFail($value);

        if ($tagTeam->currentStable->exists() && $tagTeam->currentStable->isNot($this->stable)) {
            $this->fail('This tag team is already a members of an active stable.');

            return false;
        }

        if (is_string($this->startedAt)) {
            if ($tagTeam->futureEmployment->exists() && $tagTeam->futureEmployment->startedAfter($this->startedAt)) {
                $this->fail("This tag team's future employment starts after stable's start date.");

                return false;
            }
        }

        return true;
    }

    /**
     * Undocumented function.
     *
     * @param  string $message
     * @return void
     */
    protected function fail(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
