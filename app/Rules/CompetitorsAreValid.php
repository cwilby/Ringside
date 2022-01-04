<?php

namespace App\Rules;

use App\Models\TagTeam;
use App\Models\Wrestler;
use Illuminate\Contracts\Validation\Rule;

class CompetitorsAreValid implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  array  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $wrestlers = array_filter($value, static function ($contestant) {
            return $contestant['competitor_type'] === 'wrestler';
        });

        $tagTeams = array_filter($value, static function ($contestant) {
            return $contestant['competitor_type'] === 'tag_team';
        });

        $wrestler_ids = array_column($wrestlers, 'competitor_id');

        $tag_team_ids = array_column($tagTeams, 'competitor_id');

        $existing_wrestler_ids = Wrestler::whereIn('id', $wrestler_ids)->pluck('id')->toArray();
        $existing_tag_team_ids = TagTeam::whereIn('id', $tag_team_ids)->pluck('id')->toArray();

        $diffWrestlers = array_diff($wrestler_ids, $existing_wrestler_ids);
        $diffTagTeams = array_diff($tag_team_ids, $existing_tag_team_ids);

        if (count($diffWrestlers) > 0) {
            throw new ValidationException('There are wrestlers added to the match that don\'t exist in the database.');
            // error handling
        }

        if (count($diffTagTeams) > 0) {
            // error handling
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
