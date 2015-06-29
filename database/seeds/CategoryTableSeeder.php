<?php

use \Illuminate\Database\Seeder;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->truncate();

        factory('CodeCommerce\Category', 15)->create();
    }
}