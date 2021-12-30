<?php

namespace App\Services;

use App\DataTransferObjects\VenueData;
use App\Models\Venue;
use App\Repositories\VenueRepository;

class VenueService
{
    /**
     * The repository implementation.
     *
     * @var \App\Repositories\VenueRepository
     */
    protected $venueRepository;

    /**
     * Create a new venue service instance.
     *
     * @param \App\Repositories\VenueRepository $venueRepository
     */
    public function __construct(VenueRepository $venueRepository)
    {
        $this->venueRepository = $venueRepository;
    }

    /**
     * Create a new venue with given data.
     *
     * @param  \App\DataTransferObjects\VenueData $venueData
     * @return \App\Models\Venue $venue
     */
    public function create(VenueData $venueData)
    {
        $venue = $this->venueRepository->create($venueData);

        return $venue;
    }

    /**
     * Update a given venue with given data.
     *
     * @param  \App\Models\Venue $venue
     * @param  \App\DataTransferObjects\VenueData $venueData
     * @return \App\Models\Venue $venue
     */
    public function update(Venue $venue, VenueData $venueData)
    {
        $this->venueRepository->update($venue, $venueData);

        return $venue;
    }

    /**
     * Delete a given venue.
     *
     * @param  \App\Models\Venue $venue
     * @return void
     */
    public function delete(Venue $venue): void
    {
        $this->venueRepository->delete($venue);
    }

    /**
     * Restore a given venue.
     *
     * @param  \App\Models\Venue $venue
     * @return void
     */
    public function restore(Venue $venue): void
    {
        $this->venueRepository->restore($venue);
    }
}
