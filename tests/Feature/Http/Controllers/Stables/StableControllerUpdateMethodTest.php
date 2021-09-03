<?php

namespace Tests\Feature\Http\Controllers\Stables;

use App\Enums\Role;
use App\Http\Controllers\Stables\StablesController;
use App\Http\Requests\Stables\UpdateRequest;
use App\Models\Stable;
use App\Models\Wrestler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Factories\StableRequestDataFactory;
use Tests\TestCase;

/**
 * @group stables
 * @group feature-stables
 * @group roster
 * @group feature-roster
 */
class StableControllerUpdateMethodTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function edit_returns_a_view()
    {
        $stable = Stable::factory()->create();

        $this
            ->actAs(Role::ADMINISTRATOR)
            ->get(action([StablesController::class, 'edit'], $stable))
            ->assertViewIs('stables.edit')
            ->assertViewHas('stable', $stable);
    }

    /**
     * @test
     */
    public function a_basic_user_cannot_view_the_form_for_editing_a_stable()
    {
        $stable = Stable::factory()->create();

        $this
            ->actAs(Role::BASIC)
            ->get(action([StablesController::class, 'edit'], $stable))
            ->assertForbidden();
    }

    /**
     * @test
     */
    public function a_guest_cannot_view_the_form_for_editing_a_stable()
    {
        $stable = Stable::factory()->create();

        $this
            ->get(action([StablesController::class, 'edit'], $stable))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function updates_a_stable_and_redirects()
    {
        $stable = Stable::factory()->create();

        $this
            ->actAs(Role::ADMINISTRATOR)
            ->from(action([StablesController::class, 'edit'], $stable))
            ->put(
                action([StablesController::class, 'update'], $stable),
                StableRequestDataFactory::new()->withStable($stable)->create()
            )
            ->assertRedirect(action([StablesController::class, 'index']));

        tap($stable->fresh(), function ($stable) {
            $this->assertEquals('Example Stable Name', $stable->name);
        });
    }

    public function wrestlers_of_stable_are_synced_when_stable_is_updated()
    {
        $stable = Stable::factory()->active()->create();
        $wrestlers = Wrestler::factory()->bookable()->times(2)->create();

        $this
            ->actAs(Role::ADMINISTRATOR)
            ->from(action([StablesController::class, 'edit'], $stable))
            ->put(
                action([StablesController::class, 'update'], $stable),
                StableRequestDataFactory::new()->withStable($stable)->withWrestlers([$wrestlers])->create()
            )
            ->assertRedirect(action([StablesController::class, 'index']));

        tap($stable->currentWrestlers->fresh(), function ($stableWrestlers) use ($wrestlers) {
            $this->assertCount(2, $stableWrestlers);
            $this->assertEquals($stableWrestlers->modelKeys(), $wrestlers->modelKeys());
        });
    }

    /**
     * @test
     */
    public function a_basic_user_cannot_update_a_stable()
    {
        $stable = Stable::factory()->create();

        $this
            ->actAs(Role::BASIC)
            ->from(action([StablesController::class, 'edit'], $stable))
            ->put(
                action([StablesController::class, 'update'], $stable),
                StableRequestDataFactory::new()->withStable($stable)->create()
            )
            ->assertForbidden();
    }

    /**
     * @test
     */
    public function a_guest_cannot_update_a_stable()
    {
        $stable = Stable::factory()->create();

        $this
            ->from(action([StablesController::class, 'edit'], $stable))
            ->put(
                action([StablesController::class, 'update'], $stable),
                StableRequestDataFactory::new()->withStable($stable)->create()
            )
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function update_validates_using_a_form_request()
    {
        $this->assertActionUsesFormRequest(StablesController::class, 'update', UpdateRequest::class);
    }
}
