<?php

namespace App\Rules;

use App\Enums\TitleStatus;
use App\Models\Title;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Collection;

class TitlesMustBeActive implements Rule
{
    /**
     * @var Collection
     */
    private $inActiveTitleNames;

    public function __construct()
    {
        $this->inActiveTitleNames = collect();
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
        $titlesFromRequest = Title::findMany($value);

        foreach ($titlesFromRequest as $title) {
            if (! $title->status->equals(TitleStatus::active())) {
                $this->inActiveTitleNames->push($title->name);
            }
        }

        if ($this->inActiveTitleNames->isNotEmpty()) {
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
        if ($this->inActiveTitleNames->count() == 1) {
            return $this->inActiveTitleNames->implode(',').' is not an active title and cannot be added to the match';
        }

        return $this->inActiveTitleNames->implode(', ').' are not active titles and cannot be added to the match.';
    }
}
