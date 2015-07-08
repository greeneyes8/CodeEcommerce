<?php

use \Illuminate\Database\Seeder;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('product_images')->truncate();
        DB::table('products')->truncate();

        factory('CodeCommerce\Product', 50)->create();
    }
}