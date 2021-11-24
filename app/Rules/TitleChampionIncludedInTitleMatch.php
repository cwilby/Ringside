<?php

namespace App\Rules;

use App\Models\Title;
use Illuminate\Contracts\Validation\Rule;

class TitleChampionIncludedInTitleMatch implements Rule
{
    /**
     * @var array
     */
    protected $titleIds;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $titleIds)
    {
        $this->titleIds = $titleIds;
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
        $titles = Title::findMany($this->titleIds);

        foreach ($titles as $title) {
            if (is_null($title->champion)) {
                continue;
            }

            if (in_array($title->champion->id, $value)) {
                return true;
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
        return 'This match requires the champion to be involved.';
    }
}
