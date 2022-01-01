<?php

namespace App\Models\Concerns;

use App\Models\TagTeam;

trait CanJoinTagTeams
{
    /**
     * Get the tag teams the model has been belonged to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tagTeams()
    {
        return $this->belongsToMany(TagTeam::class, 'tag_team_wrestler')->withPivot(['joined_at', 'left_at']);
    }

    /**
     * Get the current tag team the member belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function currentTagTeam()
    {
        return $this->belongsToMany(TagTeam::class, 'tag_team_wrestler')->wherePivotNull('left_at');
    }

    /**
     * Get the previous tag teams the member has belonged to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function previousTagTeams()
    {
        return $this->tagTeams()->whereNotNull('ended_at');
    }
}
