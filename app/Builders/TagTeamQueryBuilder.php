<?php

namespace App\Builders;

/**
 * @template TModelClass of \App\Models\TagTeam
 * @extends RosterMemberQueryBuilder<TModelClass>
 */
class TagTeamQueryBuilder extends RosterMemberQueryBuilder
{
    /**
     * Scope a query to only include bookable tag teams.
     *
     * @return \App\Builders\TagTeamQueryBuilder
     */
    public function bookable()
    {
        return $this->where('status', 'bookable');
    }
}
