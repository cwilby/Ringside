<?php

namespace App\Services;

use App\DataTransferObjects\StableData;
use App\Models\Stable;
use App\Repositories\StableRepository;
use Illuminate\Support\Collection;

class StableService
{
    /**
     * The repository implementation.
     *
     * @var \App\Repositories\StableRepository
     */
    protected $stableRepository;

    /**
     * Create a new stable service instance.
     *
     * @param \App\Repositories\StableRepository $stableRepository
     */
    public function __construct(StableRepository $stableRepository)
    {
        $this->stableRepository = $stableRepository;
    }

    /**
     * Create a stable with given data.
     *
     * @param  \App\DataTransferObjects\StableData $stableData
     * @return \App\Models\Stable $stable
     */
    public function create(StableData $stableData)
    {
        $stable = $this->stableRepository->create($stableData);

        if (isset($stableData->start_date)) {
            $this->stableRepository->activate($stable, $stableData->start_date);
        }

        $this->addMembers($stable, $stableData->wrestlers, $stableData->tagTeams);

        return $stable;
    }

    /**
     * Update a given stable with given data.
     *
     * @param  \App\Models\Stable $stable
     * @param  \App\DataTransferObjects\StableData $stableData
     * @return \App\Models\Stable $stable
     */
    public function update(Stable $stable, StableData $stableData)
    {
        $this->stableRepository->update($stable, $stableData);

        if (isset($stableData->start_date)) {
            $this->activateOrUpdateActivation($stable, $stableData->start_date);
        }

        $this->updateMembers($stable, $stableData->wrestlers, $stableData->tagTeams);

        return $stable;
    }

    /**
     * Delete a given stable.
     *
     * @param  \App\Models\Stable $stable
     * @return void
     */
    public function delete(Stable $stable): void
    {
        $this->stableRepository->delete($stable);
    }

    /**
     * Restore a given stable.
     *
     * @param  \App\Models\Stable $stable
     * @return void
     */
    public function restore(Stable $stable): void
    {
        $this->stableRepository->restore($stable);
    }

    /**
     * Add members to a given stable.
     *
     * @param  \App\Models\Stable $stable
     * @param  \Illuminate\Support\Collection|null $wrestlers
     * @param  \Illuminate\Support\Collection|null $tagTeams
     * @param  \Illuminate\Support\Carbon|string|null $joinedDate
     * @return \App\Models\Stable $stable
     */
    private function addMembers(
        Stable $stable,
        Collection $wrestlers = null,
        Collection $tagTeams = null,
        string $joinedDate = null
    ) {
        $joinedDate ??= now();

        if ($wrestlers) {
            $this->stableRepository->addWrestlers($stable, $wrestlers, (string) $joinedDate);
        }

        if ($tagTeams) {
            $this->stableRepository->addTagTeams($stable, $tagTeams, (string) $joinedDate);
        }

        return $stable;
    }

    /**
     * Update the members of a given stable.
     *
     * @param  \App\Models\Stable $stable
     * @param  \Illuminate\Support\Collection $wrestlers
     * @param  \Illuminate\Support\Collection $tagTeams
     * @return \App\Models\Stable $stable
     */
    private function updateMembers(Stable $stable, Collection $suggestedWrestlers, Collection $tagTeams)
    {
        $now = now()->toDateTimeString();

        if ($stable->currentWrestlers->isEmpty()) {
            $this->stableRepository->addWrestlers($stable, $suggestedWrestlers, $now);
        } else {
            /** @var Collection */
            $currentWrestlers = $stable->currentWrestlers->modelKeys();

            /** @var Collection */
            $formerWrestlers = $currentWrestlers->diff($suggestedWrestlers);

            /** @var Collection */
            $newWrestlers = $suggestedWrestlers->diff($currentWrestlers);

            $this->stableRepository->removeWrestlers($stable, $formerWrestlers, $now);
            $this->stableRepository->addWrestlers($stable, $newWrestlers, $now);
        }

        if ($stable->currentTagTeams->isEmpty()) {
            $this->stableRepository->addTagTeams($stable, $tagTeams, $now);
        } else {
            /** @var Collection */
            $currentTagTeams = $stable->currentTagTeams->pluck('id');

            /** @var Collection */
            $formerTagTeams = $currentTagTeams->diff($tagTeams);

            /** @var Collection */
            $newTagTeams = $tagTeams->diff($currentTagTeams);

            $this->stableRepository->removeTagTeams($stable, $formerTagTeams, $now);
            $this->stableRepository->addTagTeams($stable, $newTagTeams, $now);
        }

        return $stable;
    }

    /**
     * Update the activation start date of a given stable.
     *
     * @param  \App\Models\Stable $stable
     * @param  string $activationDate
     * @return \App\Models\Stable $stable
     */
    public function activateOrUpdateActivation(Stable $stable, string $activationDate)
    {
        if ($stable->isNotInActivation()) {
            $this->stableRepository->activate($stable, $activationDate);

            return $stable;
        }

        if ($stable->hasFutureActivation() && ! $stable->activatedOn($activationDate)) {
            $this->stableRepository->activate($stable, $activationDate);

            return $stable;
        }
    }

    /**
     * Add given tag teams to a given stable on a given join date.
     *
     * @param  \App\Models\Stable $stable
     * @param  Collection $tagTeams
     * @param  string $joinedDate
     * @return void
     */
    public function addTagTeams(Stable $stable, Collection $tagTeams, string $joinedDate): void
    {
        $this->stableRepository->addTagTeams($stable, $tagTeams, $joinedDate);
    }

    /**
     * Update the wrestlers of the stable.
     *
     * @param  \App\Models\Stable  $stable
     * @param  \Illuminate\Support\Collection  $wrestlers
     * @return void
     */
    public function updateWrestlers(Stable $stable, Collection $wrestlers): void
    {
        $now = now()->toDateTimeString();

        if ($stable->currentWrestlers->isEmpty()) {
            $this->stableRepository->addWrestlers($stable, $wrestlers, $now);
        } else {
            /** @var Collection */
            $currentWrestlers = $stable->currentWrestlers;

            /** @var Collection */
            $formerWrestlers = $currentWrestlers->diff($wrestlers);

            /** @var Collection */
            $newWrestlers = $wrestlers->diff($currentWrestlers);

            $this->stableRepository->removeWrestlers($stable, $formerWrestlers, $now);
            $this->stableRepository->addWrestlers($stable, $newWrestlers, $now);
        }
    }
}
