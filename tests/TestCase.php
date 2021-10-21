<?php

namespace Tests;

use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Authenticatable;

    protected function user()
    {
        //create user(factory) and select first data
       return User::factory()->create()->first();
    }
}
