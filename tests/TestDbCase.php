<?php

namespace Tests;

use Illuminate\Foundation\Testing\{
    DatabaseMigrations, TestCase as BaseTestCase
};

abstract class TestDbCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;
}
