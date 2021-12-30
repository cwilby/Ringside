<?php

namespace App\Services;

use App\DataTransferObjects\TagTeamData;
use App\Models\TagTeam;
use App\Models\Wrestler;
use App\Repositories\TagTeamRepository;
use App\Repositories\WrestlerRepository;
use Illuminate\Support\Collection;

class TagTeamService
{
    /**
     * The repository implementation.
     *
     * @var \App\Repositories\TagTeamRepository
     */
    protected $tagTeamRepository;

    /**
     * The repository implementation.
     *
     * @var \App\Repositories\WrestlerRepository
     */
    protected $wrestlerRepository;

    /**
     * Create a new tag team service instance.
     *
     * @param \App\Repositories\TagTeamRepository $tagTeamRepository
     * @param \App\Repositories\WrestlerRepository $wrestlerRepository
     */
    public function __construct(TagTeamRepository $tagTeamRepository, WrestlerRepository $wrestlerRepository)
    {
        $this->tagTeamRepository = $tagTeamRepository;
        $this->wrestlerRepository = $wrestlerRepository;
    }

    /**
     * Create a tag team with given data.
     *
     * @param  \App\DataTransferObjects\TagTeamData $tagTeamData
     * @return \App\Models\TagTeam $tagTeam
     */
    public function create(TagTeamData $tagTeamData)
    {
        $tagTeam = $this->tagTeamRepository->create($tagTeamData);

        if (isset($tagTeamData->start_date) && $tagTeamData->wrestlers->isNotEmpty()) {
            $this->tagTeamRepository->employ($tagTeam, $tagTeamData->start_date);

            $tagTeamData->wrestlers->each(
                fn (Wrestler $wrestler) => $this->wrestlerRepository->employ($wrestler, $tagTeamData->start_date)
            );

            $this->tagTeamRepository->addWrestlers($tagTeam, $tagTeamData->wrestlers, $tagTeamData->start_date);
        } else {
            if ($tagTeamData->wrestlers->isNotEmpty()) {
                $this->tagTeamRepository->addWrestlers($tagTeam, $tagTeamData->wrestlers);
            }
        }

        return $tagTeam;
    }

    /**
     * Update a given tag team with given data.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  \App\DataTransferObjects\TagTeamData $tagTeamData
     * @return \App\Models\TagTeam $tagTeam
     */
    public function update(TagTeam $tagTeam, TagTeamData $tagTeamData)
    {
        $this->tagTeamRepository->update($tagTeam, $tagTeamData);

        if ($tagTeam->canHaveEmploymentStartDateChanged() && isset($tagTeamData->start_date)) {
            $this->employOrUpdateEmployment($tagTeam, $tagTeamData->start_date);
        }

        $this->updateTagTeamPartners($tagTeam, $tagTeamData->wrestlers);

        return $tagTeam;
    }

    /**
     * Employ a given tag team or update the given tag team's employment date.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  string $employmentDate
     * @return \App\Models\TagTeam $tagTeam
     */
    public function employOrUpdateEmployment(TagTeam $tagTeam, string $employmentDate)
    {
        if ($tagTeam->isNotInEmployment()) {
            return $this->tagTeamRepository->employ($tagTeam, $employmentDate);
        }

        if ($tagTeam->hasFutureEmployment() && ! $tagTeam->employedOn($employmentDate)) {
            return $this->tagTeamRepository->updateEmployment($tagTeam, $employmentDate);
        }
    }

    /**
     * Delete a given tag team.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @return void
     */
    public function delete(TagTeam $tagTeam): void
    {
        $this->tagTeamRepository->delete($tagTeam);
    }

    /**
     * Restore a given tag team.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @return void
     */
    public function restore(TagTeam $tagTeam): void
    {
        $this->tagTeamRepository->restore($tagTeam);
    }

    /**
     * Update a given tag team with given wrestlers.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @param  \Illuminate\Support\Collection $wrestlers
     * @return \App\Models\TagTeam $tagTeam
     */
    public function updateTagTeamPartners(TagTeam $tagTeam, Collection $wrestlers)
    {
        if ($tagTeam->currentWrestlers->isEmpty()) {
            if ($wrestlers->isNotEmpty()) {
                $this->tagTeamRepository->addWrestlers($tagTeam, $wrestlers);
            }
        } else {
            $currentTagTeamPartners = collect($tagTeam->currentWrestlers->pluck('id'));
            $suggestedTagTeamPartners = collect($wrestlers);
            $formerTagTeamPartners = $currentTagTeamPartners->diff($suggestedTagTeamPartners);
            $newTagTeamPartners = $suggestedTagTeamPartners->diff($currentTagTeamPartners);

            $this->tagTeamRepository->syncTagTeamPartners($tagTeam, $formerTagTeamPartners, $newTagTeamPartners);
        }

        return $tagTeam;
    }

    /**
     * Employ a given tag team.
     *
     * @param  \App\Models\TagTeam $tagTeam
     * @return void
     */
    public function employ(TagTeam $tagTeam): void
    {
        $this->tagTeamRepository->employ($tagTeam, now()->toDateTimeString());
    }
}
