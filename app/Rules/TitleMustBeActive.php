<?php

namespace App\Rules;

use App\Enums\TitleStatus;
use App\Models\Title;
use Illuminate\Contracts\Validation\Rule;

class TitleMustBeActive implements Rule
{
    /**
     * @var Title
     */
    private $title;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->title = Title::find($value);

        if (! $this->title->status->equals(TitleStatus::active())) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->title->name.' cannot be added to the match.';
    }
}
