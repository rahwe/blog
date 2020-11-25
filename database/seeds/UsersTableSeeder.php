<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * create user with specific name with factory for easy to use 
         * for login by using states
         *  */ 
        $userCount = max((int)$this->command->ask('How many user do you want to create?', 20), 1);
        factory(App\User::class)->states('rahwee')->create();

         /**
         * create user with factory with 20 users and name ramdomly
         * 
         *  */ 

        factory(App\User::class, $userCount)->create();
    }
}
