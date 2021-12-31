<?php

namespace App\Services;

use App\DataTransferObjects\TitleData;
use App\Models\Title;
use App\Repositories\TitleRepository;

class TitleService
{
    /**
     * The repository implementation.
     *
     * @var \App\Repositories\TitleRepository
     */
    protected $titleRepository;

    /**
     * Create a new title service instance.
     *
     * @param \App\Repositories\TitleRepository $titleRepository
     */
    public function __construct(TitleRepository $titleRepository)
    {
        $this->titleRepository = $titleRepository;
    }

    /**
     * Create a title with given data.
     *
     * @param  \App\DataTransferObjects\TitleData $titleData
     * @return \App\Models\Title
     */
    public function create(TitleData $titleData)
    {
        $title = $this->titleRepository->create($titleData);

        if (! is_null($titleData->activation_date)) {
            $this->titleRepository->activate($title, $titleData->activation_date);
        }

        return $title;
    }

    /**
     * Update a given title with given data.
     *
     * @param  \App\Models\Title $title
     * @param  \App\DataTransferObjects\TitleData $titleData
     * @return \App\Models\Title $title
     */
    public function update(Title $title, TitleData $titleData)
    {
        $this->titleRepository->update($title, $titleData);

        if ($title->canHaveActivationStartDateChanged() && ! is_null($titleData->activation_date)) {
            $this->activateOrUpdateActivation($title, $titleData->activation_date);
        }

        return $title;
    }

    /**
     * Activate a given manager or update the given title's activation date.
     *
     * @param  \App\Models\Title $title
     * @param  string $activationDate
     * @return \App\Models\Title
     */
    public function activateOrUpdateActivation(Title $title, string $activationDate)
    {
        return $this->titleRepository->activate($title, $activationDate);
    }

    /**
     * Delete a given title.
     *
     * @param  \App\Models\Title $title
     * @return void
     */
    public function delete(Title $title): void
    {
        $this->titleRepository->delete($title);
    }

    /**
     * Restore a given title.
     *
     * @param  \App\Models\Title $title
     * @return void
     */
    public function restore(Title $title): void
    {
        $this->titleRepository->restore($title);
    }
}
