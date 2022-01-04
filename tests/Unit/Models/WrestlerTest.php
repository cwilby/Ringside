<?php

namespace Tests\Unit\Models;

use App\Enums\WrestlerStatus;
use App\Height;
use App\Models\Contracts\Bookable;
use App\Models\Contracts\StableMember;
use App\Models\SingleRosterMember;
use App\Models\Wrestler;
use Tests\TestCase;

/**
 * @group wrestlers
 * @group roster
 * @group models
 */
class WrestlerTest extends TestCase
{
    /**
     * @test
     */
    public function a_wrestler_height_gets_cast_as_a_height_enum(): void
    {
        $wrestler = Wrestler::factory()->make();

        $this->assertInstanceOf(Height::class, $wrestler->height);
    }

    /**
     * @test
     */
    public function a_wrestler_is_a_single_roster_member(): void
    {
        $this->assertEquals(SingleRosterMember::class, get_parent_class(Wrestler::class));
    }

    /**
     * @test
     */
    public function a_wrestler_status_gets_cast_as_a_wrestler_status_enum(): void
    {
        $wrestler = Wrestler::factory()->make();

        $this->assertInstanceOf(WrestlerStatus::class, $wrestler->status);
    }

    /**
     * @test
     */
    public function a_wrestler_uses_soft_deleted_trait(): void
    {
        $this->assertUsesTrait('Illuminate\Database\Eloquent\SoftDeletes', Wrestler::class);
    }

    /**
     * @test
     */
    public function a_wrestler_uses_can_be_stable_member_trait(): void
    {
        $this->assertUsesTrait('App\Models\Concerns\StableMember', Wrestler::class);
    }

    /**
     * @test
     */
    public function a_wrestler_implements_bookable_interface(): void
    {
        $this->assertContains(Bookable::class, class_implements(Wrestler::class));
    }

    /**
     * @test
     */
    public function a_wrestler_implements_stable_member_interface(): void
    {
        $this->assertContains(StableMember::class, class_implements(Wrestler::class));
    }
}
