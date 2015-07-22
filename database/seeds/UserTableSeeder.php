<?php

use \Illuminate\Database\Seeder;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        factory('CodeCommerce\User')->create(
            [
                'name'     => 'Luis Fernando Serra',
                'email'    => 'luis_serra@hotmail.com',
                'is_admin' => true,
                'password' => Hash::make('123456')
            ]
        );

        factory('CodeCommerce\User', 30)->create();
    }
}