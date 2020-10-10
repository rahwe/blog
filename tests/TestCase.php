<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    

    /**
     * Because user seem to be important for the application
     * we need to create user. but for testing we are using
     * different database as below
     * 
     * 
     * 'sqlite_testing' => [
      *      'driver' => 'sqlite',
       *     'database' => ':memory:',
           
        *   ],
        * so we use data faker to create user
     */

     protected function user()
     {
         return factory(User::class)->create();
     }
}
