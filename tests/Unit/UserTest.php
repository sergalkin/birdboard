<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_projects()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_accessible_projects()
    {
        $john = $this->signIn();

        ProjectFactory::ownedBy($john)->create();

        $this->assertCount(1, $john->attendingProjects());

        [$sally, $nick] = factory(User::class, 2)->create();

        $sallyProjects = ProjectFactory::ownedBy($sally)->create();
        $sallyProjects->invite($nick);

        $this->assertCount(1, $john->attendingProjects());

        $sallyProjects->invite($john);

        $this->assertCount(2, $john->attendingProjects());
    }
}
