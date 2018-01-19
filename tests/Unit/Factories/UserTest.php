<?php

namespace Tests\Unit\Factories;

use App\Models\User;
use Tests\TestDbCase as Test;

/**
 * @property User $user
 * Class UserTest
 * @package Tests\Unit\Factories
 */
class UserTest extends Test
{

    public function testCreateArticle()
    {
        $this->user = factory(User::class)->create();

        $this->assertDatabaseHas('users', $this->user->toArray());
    }

}
