<?php

use \Illuminate\Database\Seeder;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tags')->truncate();

        factory('CodeCommerce\Tag', 10)->create();
    }
}