<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */

namespace App\Models{
    /**
     * App\Models\Activation.
     *
     * @property int $id
     * @property string $activatable_type
     * @property int $activatable_id
     * @property \Illuminate\Support\Carbon $started_at
     * @property \Illuminate\Support\Carbon|null $ended_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $activatable
     * @method static \Database\Factories\ActivationFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Activation newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Activation newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Activation query()
     * @method static \Illuminate\Database\Eloquent\Builder|Activation whereActivatableId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Activation whereActivatableType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Activation whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Activation whereEndedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Activation whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Activation whereStartedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Activation whereUpdatedAt($value)
     */
    class Activation extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Competitor.
     *
     * @method static \Illuminate\Database\Eloquent\Builder|Competitor newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Competitor newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Competitor query()
     */
    class Competitor extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Employment.
     *
     * @property int $id
     * @property string $employable_type
     * @property int $employable_id
     * @property \Illuminate\Support\Carbon $started_at
     * @property \Illuminate\Support\Carbon|null $ended_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $employable
     * @method static \Database\Factories\EmploymentFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Employment newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Employment query()
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployableId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEmployableType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereEndedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereStartedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Employment whereUpdatedAt($value)
     */
    class Employment extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Event.
     *
     * @property int $id
     * @property string $name
     * @property \Illuminate\Support\Carbon|null $date
     * @property int|null $venue_id
     * @property string|null $preview
     * @property string $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventMatch[] $matches
     * @property-read int|null $matches_count
     * @property-read \App\Models\Venue|null $venue
     * @method static \Database\Factories\EventFactory factory(...$parameters)
     * @method static \App\Builders\EventQueryBuilder|Event newModelQuery()
     * @method static \App\Builders\EventQueryBuilder|Event newQuery()
     * @method static \Illuminate\Database\Query\Builder|Event onlyTrashed()
     * @method static \App\Builders\EventQueryBuilder|Event past()
     * @method static \App\Builders\EventQueryBuilder|Event query()
     * @method static \App\Builders\EventQueryBuilder|Event scheduled()
     * @method static \App\Builders\EventQueryBuilder|Event unscheduled()
     * @method static \App\Builders\EventQueryBuilder|Event whereCreatedAt($value)
     * @method static \App\Builders\EventQueryBuilder|Event whereDate($value)
     * @method static \App\Builders\EventQueryBuilder|Event whereDeletedAt($value)
     * @method static \App\Builders\EventQueryBuilder|Event whereId($value)
     * @method static \App\Builders\EventQueryBuilder|Event whereName($value)
     * @method static \App\Builders\EventQueryBuilder|Event wherePreview($value)
     * @method static \App\Builders\EventQueryBuilder|Event whereStatus($value)
     * @method static \App\Builders\EventQueryBuilder|Event whereUpdatedAt($value)
     * @method static \App\Builders\EventQueryBuilder|Event whereVenueId($value)
     * @method static \Illuminate\Database\Query\Builder|Event withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Event withoutTrashed()
     */
    class Event extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\EventMatch.
     *
     * @property int $id
     * @property int $event_id
     * @property int $match_type_id
     * @property string|null $preview
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $competitors
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Referee[] $referees
     * @property-read int|null $referees_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Title[] $titles
     * @property-read int|null $titles_count
     * @method static \Database\Factories\EventMatchFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch query()
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch whereEventId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch whereMatchTypeId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch wherePreview($value)
     * @method static \Illuminate\Database\Eloquent\Builder|EventMatch whereUpdatedAt($value)
     */
    class EventMatch extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Injury.
     *
     * @property int $id
     * @property string $injurable_type
     * @property int $injurable_id
     * @property \Illuminate\Support\Carbon $started_at
     * @property \Illuminate\Support\Carbon|null $ended_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $injurable
     * @method static \Database\Factories\InjuryFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Injury newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Injury newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Injury query()
     * @method static \Illuminate\Database\Eloquent\Builder|Injury whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Injury whereEndedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Injury whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Injury whereInjurableId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Injury whereInjurableType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Injury whereStartedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Injury whereUpdatedAt($value)
     */
    class Injury extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Manager.
     *
     * @property int $id
     * @property int|null $user_id
     * @property string $first_name
     * @property string $last_name
     * @property \App\Enums\ManagerStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \App\Models\Employment|null $currentEmployment
     * @property-read \App\Models\Injury|null $currentInjury
     * @property-read \App\Models\Retirement|null $currentRetirement
     * @property-read \App\Models\Suspension|null $currentSuspension
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\TagTeam> $currentTagTeams
     * @property-read int|null $current_tag_teams_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Wrestler> $currentWrestlers
     * @property-read int|null $current_wrestlers_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Employment[] $employments
     * @property-read int|null $employments_count
     * @property-read \App\Models\Employment|null $firstEmployment
     * @property-read \App\Models\Employment|null $futureEmployment
     * @property-read string $full_name
     * @property-read string|null $started_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Injury[] $injuries
     * @property-read int|null $injuries_count
     * @property-read \App\Models\Employment|null $previousEmployment
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Employment[] $previousEmployments
     * @property-read int|null $previous_employments_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Injury[] $previousInjuries
     * @property-read int|null $previous_injuries_count
     * @property-read \App\Models\Injury|null $previousInjury
     * @property-read \App\Models\Retirement|null $previousRetirement
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $previousRetirements
     * @property-read int|null $previous_retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stable[] $previousStables
     * @property-read int|null $previous_stables_count
     * @property-read \App\Models\Suspension|null $previousSuspension
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Suspension[] $previousSuspensions
     * @property-read int|null $previous_suspensions_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\TagTeam> $previousTagTeams
     * @property-read int|null $previous_tag_teams_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Wrestler> $previousWrestlers
     * @property-read int|null $previous_wrestlers_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $retirements
     * @property-read int|null $retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stable[] $stables
     * @property-read int|null $stables_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Suspension[] $suspensions
     * @property-read int|null $suspensions_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\TagTeam> $tagTeams
     * @property-read int|null $tag_teams_count
     * @property-read \App\Models\User|null $user
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Wrestler> $wrestlers
     * @property-read int|null $wrestlers_count
     * @method static \App\Builders\ManagerQueryBuilder|Manager available()
     * @method static \App\Builders\ManagerQueryBuilder|Manager bookable()
     * @method static \App\Builders\ManagerQueryBuilder|Manager employed()
     * @method static \Database\Factories\ManagerFactory factory(...$parameters)
     * @method static \App\Builders\ManagerQueryBuilder|Manager futureEmployed()
     * @method static \App\Builders\ManagerQueryBuilder|Manager injured()
     * @method static \App\Builders\ManagerQueryBuilder|Manager newModelQuery()
     * @method static \App\Builders\ManagerQueryBuilder|Manager newQuery()
     * @method static \Illuminate\Database\Query\Builder|Manager onlyTrashed()
     * @method static \App\Builders\ManagerQueryBuilder|Manager orderByCurrentInjuredAtDate(string $direction = 'asc')
     * @method static \App\Builders\ManagerQueryBuilder|Manager orderByCurrentReleasedAtDate(string $direction = 'asc')
     * @method static \App\Builders\ManagerQueryBuilder|Manager orderByCurrentRetiredAtDate(string $direction = 'asc')
     * @method static \App\Builders\ManagerQueryBuilder|Manager orderByCurrentSuspendedAtDate(string $direction = 'asc')
     * @method static \App\Builders\ManagerQueryBuilder|Manager orderByFirstEmployedAtDate(string $direction = 'asc')
     * @method static \App\Builders\ManagerQueryBuilder|Manager query()
     * @method static \App\Builders\ManagerQueryBuilder|Manager released()
     * @method static \App\Builders\ManagerQueryBuilder|Manager retired()
     * @method static \App\Builders\ManagerQueryBuilder|Manager suspended()
     * @method static \App\Builders\ManagerQueryBuilder|Manager unemployed()
     * @method static \App\Builders\ManagerQueryBuilder|Manager whereCreatedAt($value)
     * @method static \App\Builders\ManagerQueryBuilder|Manager whereDeletedAt($value)
     * @method static \App\Builders\ManagerQueryBuilder|Manager whereFirstName($value)
     * @method static \App\Builders\ManagerQueryBuilder|Manager whereId($value)
     * @method static \App\Builders\ManagerQueryBuilder|Manager whereLastName($value)
     * @method static \App\Builders\ManagerQueryBuilder|Manager whereStatus($value)
     * @method static \App\Builders\ManagerQueryBuilder|Manager whereUpdatedAt($value)
     * @method static \App\Builders\ManagerQueryBuilder|Manager whereUserId($value)
     * @method static \App\Builders\ManagerQueryBuilder|Manager withCurrentInjuredAtDate()
     * @method static \App\Builders\ManagerQueryBuilder|Manager withCurrentRetiredAtDate()
     * @method static \App\Builders\ManagerQueryBuilder|Manager withCurrentSuspendedAtDate()
     * @method static \App\Builders\ManagerQueryBuilder|Manager withFirstEmployedAtDate()
     * @method static \App\Builders\ManagerQueryBuilder|Manager withReleasedAtDate()
     * @method static \Illuminate\Database\Query\Builder|Manager withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Manager withoutTrashed()
     */
    class Manager extends \Eloquent implements \App\Models\Contracts\CanBeAStableMember
    {
    }
}

namespace App\Models{
    /**
     * App\Models\MatchDecision.
     *
     * @property int $id
     * @property string $name
     * @property string $slug
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Illuminate\Database\Eloquent\Builder|MatchDecision newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|MatchDecision newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|MatchDecision query()
     * @method static \Illuminate\Database\Eloquent\Builder|MatchDecision whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchDecision whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchDecision whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchDecision whereSlug($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchDecision whereUpdatedAt($value)
     */
    class MatchDecision extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\MatchType.
     *
     * @property int $id
     * @property string $name
     * @property string $slug
     * @property int|null $number_of_sides
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Database\Factories\MatchTypeFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType query()
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType whereNumberOfSides($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType whereSlug($value)
     * @method static \Illuminate\Database\Eloquent\Builder|MatchType whereUpdatedAt($value)
     */
    class MatchType extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Referee.
     *
     * @property int $id
     * @property string $first_name
     * @property string $last_name
     * @property \App\Enums\RefereeStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \App\Models\Employment|null $currentEmployment
     * @property-read \App\Models\Injury|null $currentInjury
     * @property-read \App\Models\Retirement|null $currentRetirement
     * @property-read \App\Models\Suspension|null $currentSuspension
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Employment[] $employments
     * @property-read int|null $employments_count
     * @property-read \App\Models\Employment|null $firstEmployment
     * @property-read \App\Models\Employment|null $futureEmployment
     * @property-read string $full_name
     * @property-read string|null $started_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Injury[] $injuries
     * @property-read int|null $injuries_count
     * @property-read \App\Models\Employment|null $previousEmployment
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Employment[] $previousEmployments
     * @property-read int|null $previous_employments_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Injury[] $previousInjuries
     * @property-read int|null $previous_injuries_count
     * @property-read \App\Models\Injury|null $previousInjury
     * @property-read \App\Models\Retirement|null $previousRetirement
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $previousRetirements
     * @property-read int|null $previous_retirements_count
     * @property-read \App\Models\Suspension|null $previousSuspension
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Suspension[] $previousSuspensions
     * @property-read int|null $previous_suspensions_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $retirements
     * @property-read int|null $retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Suspension[] $suspensions
     * @property-read int|null $suspensions_count
     * @method static \App\Builders\RefereeQueryBuilder|Referee bookable()
     * @method static \App\Builders\RefereeQueryBuilder|Referee employed()
     * @method static \Database\Factories\RefereeFactory factory(...$parameters)
     * @method static \App\Builders\RefereeQueryBuilder|Referee futureEmployed()
     * @method static \App\Builders\RefereeQueryBuilder|Referee injured()
     * @method static \App\Builders\RefereeQueryBuilder|Referee newModelQuery()
     * @method static \App\Builders\RefereeQueryBuilder|Referee newQuery()
     * @method static \Illuminate\Database\Query\Builder|Referee onlyTrashed()
     * @method static \App\Builders\RefereeQueryBuilder|Referee orderByCurrentInjuredAtDate(string $direction = 'asc')
     * @method static \App\Builders\RefereeQueryBuilder|Referee orderByCurrentReleasedAtDate(string $direction = 'asc')
     * @method static \App\Builders\RefereeQueryBuilder|Referee orderByCurrentRetiredAtDate(string $direction = 'asc')
     * @method static \App\Builders\RefereeQueryBuilder|Referee orderByCurrentSuspendedAtDate(string $direction = 'asc')
     * @method static \App\Builders\RefereeQueryBuilder|Referee orderByFirstEmployedAtDate(string $direction = 'asc')
     * @method static \App\Builders\RefereeQueryBuilder|Referee query()
     * @method static \App\Builders\RefereeQueryBuilder|Referee released()
     * @method static \App\Builders\RefereeQueryBuilder|Referee retired()
     * @method static \App\Builders\RefereeQueryBuilder|Referee suspended()
     * @method static \App\Builders\RefereeQueryBuilder|Referee unemployed()
     * @method static \App\Builders\RefereeQueryBuilder|Referee whereCreatedAt($value)
     * @method static \App\Builders\RefereeQueryBuilder|Referee whereDeletedAt($value)
     * @method static \App\Builders\RefereeQueryBuilder|Referee whereFirstName($value)
     * @method static \App\Builders\RefereeQueryBuilder|Referee whereId($value)
     * @method static \App\Builders\RefereeQueryBuilder|Referee whereLastName($value)
     * @method static \App\Builders\RefereeQueryBuilder|Referee whereStatus($value)
     * @method static \App\Builders\RefereeQueryBuilder|Referee whereUpdatedAt($value)
     * @method static \App\Builders\RefereeQueryBuilder|Referee withCurrentInjuredAtDate()
     * @method static \App\Builders\RefereeQueryBuilder|Referee withCurrentRetiredAtDate()
     * @method static \App\Builders\RefereeQueryBuilder|Referee withCurrentSuspendedAtDate()
     * @method static \App\Builders\RefereeQueryBuilder|Referee withFirstEmployedAtDate()
     * @method static \App\Builders\RefereeQueryBuilder|Referee withReleasedAtDate()
     * @method static \Illuminate\Database\Query\Builder|Referee withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Referee withoutTrashed()
     */
    class Referee extends \Eloquent implements \App\Models\Contracts\Bookable
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Retirement.
     *
     * @property int $id
     * @property string $retiree_type
     * @property int $retiree_id
     * @property \Illuminate\Support\Carbon $started_at
     * @property \Illuminate\Support\Carbon|null $ended_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $retiree
     * @method static \Database\Factories\RetirementFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement query()
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement whereEndedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement whereRetireeId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement whereRetireeType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement whereStartedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Retirement whereUpdatedAt($value)
     */
    class Retirement extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Stable.
     *
     * @property int $id
     * @property int|null $user_id
     * @property string $name
     * @property \App\Enums\StableStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activation[] $activations
     * @property-read int|null $activations_count
     * @property-read \App\Models\Activation|null $currentActivation
     * @property-read \App\Models\Retirement|null $currentRetirement
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\TagTeam> $currentTagTeams
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Wrestler> $currentWrestlers
     * @property-read \App\Models\Activation|null $firstActivation
     * @property-read \App\Models\Activation|null $futureActivation
     * @property-read string|null $activated_at
     * @property-read \Illuminate\Support\Collection $members
     * @property-read \App\Models\Activation|null $previousActivation
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activation[] $previousActivations
     * @property-read int|null $previous_activations_count
     * @property-read \App\Models\Retirement|null $previousRetirement
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $previousRetirements
     * @property-read int|null $previous_retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $retirements
     * @property-read int|null $retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\TagTeam> $tagTeams
     * @property-read int|null $tag_teams_count
     * @property-read \App\Models\User|null $user
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Wrestler> $wrestlers
     * @property-read int|null $wrestlers_count
     * @method static \App\Builders\StableQueryBuilder|Stable active()
     * @method static \App\Builders\StableQueryBuilder|Stable deactivated()
     * @method static \Database\Factories\StableFactory factory(...$parameters)
     * @method static \App\Builders\StableQueryBuilder|Stable inactive()
     * @method static \App\Builders\StableQueryBuilder|Stable newModelQuery()
     * @method static \App\Builders\StableQueryBuilder|Stable newQuery()
     * @method static \Illuminate\Database\Query\Builder|Stable onlyTrashed()
     * @method static \App\Builders\StableQueryBuilder|Stable orderByCurrentRetiredAtDate($direction = 'asc')
     * @method static \App\Builders\StableQueryBuilder|Stable orderByFirstActivatedAtDate(string $direction = 'asc')
     * @method static \App\Builders\StableQueryBuilder|Stable orderByLastDeactivationDate(string $direction = 'asc')
     * @method static \App\Builders\StableQueryBuilder|Stable query()
     * @method static \App\Builders\StableQueryBuilder|Stable retired()
     * @method static \App\Builders\StableQueryBuilder|Stable unactivated()
     * @method static \App\Builders\StableQueryBuilder|Stable whereCreatedAt($value)
     * @method static \App\Builders\StableQueryBuilder|Stable whereDeletedAt($value)
     * @method static \App\Builders\StableQueryBuilder|Stable whereId($value)
     * @method static \App\Builders\StableQueryBuilder|Stable whereName($value)
     * @method static \App\Builders\StableQueryBuilder|Stable whereStatus($value)
     * @method static \App\Builders\StableQueryBuilder|Stable whereUpdatedAt($value)
     * @method static \App\Builders\StableQueryBuilder|Stable whereUserId($value)
     * @method static \App\Builders\StableQueryBuilder|Stable withCurrentRetiredAtDate()
     * @method static \App\Builders\StableQueryBuilder|Stable withFirstActivatedAtDate()
     * @method static \App\Builders\StableQueryBuilder|Stable withFutureActivation()
     * @method static \App\Builders\StableQueryBuilder|Stable withLastDeactivationDate()
     * @method static \Illuminate\Database\Query\Builder|Stable withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Stable withoutTrashed()
     */
    class Stable extends \Eloquent implements \App\Models\Contracts\Activatable, \App\Models\Contracts\Deactivatable, \App\Models\Contracts\Retirable
    {
    }
}

namespace App\Models{
    /**
     * App\Models\StableMember.
     *
     * @method static \Illuminate\Database\Eloquent\Builder|StableMember newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|StableMember newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|StableMember query()
     */
    class StableMember extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Suspension.
     *
     * @property int $id
     * @property string $suspendable_type
     * @property int $suspendable_id
     * @property \Illuminate\Support\Carbon $started_at
     * @property \Illuminate\Support\Carbon|null $ended_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $suspendable
     * @method static \Database\Factories\SuspensionFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension query()
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension whereEndedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension whereStartedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension whereSuspendableId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension whereSuspendableType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Suspension whereUpdatedAt($value)
     */
    class Suspension extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\TagTeam.
     *
     * @property int $id
     * @property int|null $user_id
     * @property string $name
     * @property string|null $signature_move
     * @property \App\Enums\TagTeamStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \App\Models\Employment|null $currentEmployment
     * @property-read \App\Models\Retirement|null $currentRetirement
     * @property-read \App\Models\Stable|null $currentStable
     * @property-read \App\Models\Suspension|null $currentSuspension
     * @property-read \Illuminate\Database\Eloquent\Collection $currentWrestlers
     * @property-read int|null $current_wrestlers_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Employment[] $employments
     * @property-read int|null $employments_count
     * @property-read \App\Models\Employment|null $firstEmployment
     * @property-read \App\Models\Employment|null $futureEmployment
     * @property-read int $combined_weight
     * @property-read string|null $started_at
     * @property-read \App\Models\Employment|null $previousEmployment
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Employment[] $previousEmployments
     * @property-read int|null $previous_employments_count
     * @property-read \App\Models\Retirement|null $previousRetirement
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $previousRetirements
     * @property-read int|null $previous_retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stable[] $previousStables
     * @property-read int|null $previous_stables_count
     * @property-read \App\Models\Suspension|null $previousSuspension
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Suspension[] $previousSuspensions
     * @property-read int|null $previous_suspensions_count
     * @property-read \Illuminate\Database\Eloquent\Collection $previousWrestlers
     * @property-read int|null $previous_wrestlers_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $retirements
     * @property-read int|null $retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Stable[] $stables
     * @property-read int|null $stables_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Suspension[] $suspensions
     * @property-read int|null $suspensions_count
     * @property-read \App\Models\User|null $user
     * @property-read \Illuminate\Database\Eloquent\Collection $wrestlers
     * @property-read int|null $wrestlers_count
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam bookable()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam employed()
     * @method static \Database\Factories\TagTeamFactory factory(...$parameters)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam futureEmployed()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam newModelQuery()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam newQuery()
     * @method static \Illuminate\Database\Query\Builder|TagTeam onlyTrashed()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam orderByCurrentReleasedAtDate(string $direction = 'asc')
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam orderByCurrentRetiredAtDate(string $direction = 'asc')
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam orderByCurrentSuspendedAtDate(string $direction = 'asc')
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam orderByFirstEmployedAtDate(string $direction = 'asc')
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam query()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam released()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam retired()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam suspended()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam unemployed()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam whereCreatedAt($value)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam whereDeletedAt($value)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam whereId($value)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam whereName($value)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam whereSignatureMove($value)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam whereStatus($value)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam whereUpdatedAt($value)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam whereUserId($value)
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam withCurrentRetiredAtDate()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam withCurrentSuspendedAtDate()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam withFirstEmployedAtDate()
     * @method static \App\Builders\TagTeamQueryBuilder|TagTeam withReleasedAtDate()
     * @method static \Illuminate\Database\Query\Builder|TagTeam withTrashed()
     * @method static \Illuminate\Database\Query\Builder|TagTeam withoutTrashed()
     */
    class TagTeam extends \Eloquent implements \App\Models\Contracts\Bookable, \App\Models\Contracts\CanBeAStableMember
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Title.
     *
     * @property int $id
     * @property string $name
     * @property \App\Enums\TitleStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activation[] $activations
     * @property-read int|null $activations_count
     * @property-read \App\Models\Activation|null $currentActivation
     * @property-read \App\Models\Retirement|null $currentRetirement
     * @property-read \App\Models\Activation|null $firstActivation
     * @property-read \App\Models\Activation|null $futureActivation
     * @property-read string|null $activated_at
     * @property-read \App\Models\Activation|null $previousActivation
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activation[] $previousActivations
     * @property-read int|null $previous_activations_count
     * @property-read \App\Models\Retirement|null $previousRetirement
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $previousRetirements
     * @property-read int|null $previous_retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retirement[] $retirements
     * @property-read int|null $retirements_count
     * @method static \App\Builders\TitleQueryBuilder|Title active()
     * @method static \App\Builders\TitleQueryBuilder|Title competable()
     * @method static \App\Builders\TitleQueryBuilder|Title deactivated()
     * @method static \Database\Factories\TitleFactory factory(...$parameters)
     * @method static \App\Builders\TitleQueryBuilder|Title inactive()
     * @method static \App\Builders\TitleQueryBuilder|Title newModelQuery()
     * @method static \App\Builders\TitleQueryBuilder|Title newQuery()
     * @method static \Illuminate\Database\Query\Builder|Title onlyTrashed()
     * @method static \App\Builders\TitleQueryBuilder|Title orderByCurrentRetiredAtDate($direction = 'asc')
     * @method static \App\Builders\TitleQueryBuilder|Title orderByFirstActivatedAtDate(string $direction = 'asc')
     * @method static \App\Builders\TitleQueryBuilder|Title orderByLastDeactivationDate(string $direction = 'asc')
     * @method static \App\Builders\TitleQueryBuilder|Title query()
     * @method static \App\Builders\TitleQueryBuilder|Title retired()
     * @method static \App\Builders\TitleQueryBuilder|Title unactivated()
     * @method static \App\Builders\TitleQueryBuilder|Title whereCreatedAt($value)
     * @method static \App\Builders\TitleQueryBuilder|Title whereDeletedAt($value)
     * @method static \App\Builders\TitleQueryBuilder|Title whereId($value)
     * @method static \App\Builders\TitleQueryBuilder|Title whereName($value)
     * @method static \App\Builders\TitleQueryBuilder|Title whereStatus($value)
     * @method static \App\Builders\TitleQueryBuilder|Title whereUpdatedAt($value)
     * @method static \App\Builders\TitleQueryBuilder|Title withCurrentRetiredAtDate()
     * @method static \App\Builders\TitleQueryBuilder|Title withFirstActivatedAtDate()
     * @method static \App\Builders\TitleQueryBuilder|Title withFutureActivation()
     * @method static \App\Builders\TitleQueryBuilder|Title withLastDeactivationDate()
     * @method static \Illuminate\Database\Query\Builder|Title withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Title withoutTrashed()
     */
    class Title extends \Eloquent implements \App\Models\Contracts\Activatable, \App\Models\Contracts\Deactivatable, \App\Models\Contracts\Retirable
    {
    }
}

namespace App\Models{
    /**
     * App\Models\User.
     *
     * @property int $id
     * @property string $first_name
     * @property string $last_name
     * @property string $email
     * @property string|null $email_verified_at
     * @property string $password
     * @property \App\Enums\Role $role
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \App\Models\Wrestler|null $wrestler
     * @method static \Database\Factories\UserFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     */
    class User extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Venue.
     *
     * @property int $id
     * @property string $name
     * @property string $address1
     * @property string|null $address2
     * @property string $city
     * @property string $state
     * @property string $zip
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @method static \Database\Factories\VenueFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Venue newQuery()
     * @method static \Illuminate\Database\Query\Builder|Venue onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|Venue query()
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereAddress1($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereAddress2($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCity($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereState($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Venue whereZip($value)
     * @method static \Illuminate\Database\Query\Builder|Venue withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Venue withoutTrashed()
     */
    class Venue extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\Wrestler.
     *
     * @property int $id
     * @property int|null $user_id
     * @property string $name
     * @property mixed $height
     * @property int $weight
     * @property string $hometown
     * @property string|null $signature_move
     * @property \App\Enums\WrestlerStatus $status
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \App\Models\Employment|null $currentEmployment
     * @property-read \App\Models\Injury|null $currentInjury
     * @property-read \App\Models\Retirement|null $currentRetirement
     * @property-read \App\Models\Suspension|null $currentSuspension
     * @property-read \App\Models\TagTeam|null $currentTagTeam
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Employment> $employments
     * @property-read int|null $employments_count
     * @property-read \App\Models\Employment|null $firstEmployment
     * @property-read \App\Models\Employment|null $futureEmployment
     * @property-read string|null $started_at
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Injury> $injuries
     * @property-read int|null $injuries_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Manager> $managers
     * @property-read int|null $managers_count
     * @property-read \App\Models\Employment|null $previousEmployment
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Employment> $previousEmployments
     * @property-read int|null $previous_employments_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Injury> $previousInjuries
     * @property-read int|null $previous_injuries_count
     * @property-read \App\Models\Injury|null $previousInjury
     * @property-read \App\Models\Retirement|null $previousRetirement
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Retirement> $previousRetirements
     * @property-read int|null $previous_retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Stable> $previousStables
     * @property-read int|null $previous_stables_count
     * @property-read \App\Models\Suspension|null $previousSuspension
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Suspension> $previousSuspensions
     * @property-read int|null $previous_suspensions_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\TagTeam> $previousTagTeams
     * @property-read int|null $previous_tag_teams_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Retirement> $retirements
     * @property-read int|null $retirements_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Stable> $stables
     * @property-read int|null $stables_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Suspension> $suspensions
     * @property-read int|null $suspensions_count
     * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\TagTeam> $tagTeams
     * @property-read int|null $tag_teams_count
     * @property-read \App\Models\User|null $user
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler bookable()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler employed()
     * @method static \Database\Factories\WrestlerFactory factory(...$parameters)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler futureEmployed()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler injured()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler newModelQuery()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler newQuery()
     * @method static \Illuminate\Database\Query\Builder|Wrestler onlyTrashed()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler orderByCurrentInjuredAtDate(string $direction = 'asc')
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler orderByCurrentReleasedAtDate(string $direction = 'asc')
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler orderByCurrentRetiredAtDate(string $direction = 'asc')
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler orderByCurrentSuspendedAtDate(string $direction = 'asc')
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler orderByFirstEmployedAtDate(string $direction = 'asc')
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler query()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler released()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler retired()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler suspended()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler unemployed()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereCreatedAt($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereDeletedAt($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereHeight($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereHometown($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereId($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereName($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereSignatureMove($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereStatus($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereUpdatedAt($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereUserId($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler whereWeight($value)
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler withCurrentInjuredAtDate()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler withCurrentRetiredAtDate()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler withCurrentSuspendedAtDate()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler withFirstEmployedAtDate()
     * @method static \App\Builders\WrestlerQueryBuilder|Wrestler withReleasedAtDate()
     * @method static \Illuminate\Database\Query\Builder|Wrestler withTrashed()
     * @method static \Illuminate\Database\Query\Builder|Wrestler withoutTrashed()
     */
    class Wrestler extends \Eloquent implements \App\Models\Contracts\Bookable, \App\Models\Contracts\CanBeAStableMember, \App\Models\Contracts\Manageable, \App\Models\Contracts\TagTeamMember
    {
    }
}
