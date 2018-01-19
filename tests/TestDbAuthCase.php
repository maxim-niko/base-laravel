<?php

namespace Tests;

use App\Models\User;

/**
 *
 * @property User $user
 *
 * Class TestDbAuthCase
 * @package Tests
 */
abstract class TestDbAuthCase extends TestDbCase
{

    public function setUp()
    {
        parent::setUp();
        $this->logIn();
    }

    private function logIn()
    {
        $this->user = factory(User::class)->create();
        $this->user->confirmed = 1;
        $this->be($this->user);
    }

}
