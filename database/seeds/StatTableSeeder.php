<?php

use CodeCommerce\Stat;
use Illuminate\Database\Seeder;

class StatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stats')->truncate();

        Stat::create(['name' => 'Aberto']);
        Stat::create(['name' => 'Aguar. Pagamento']);
        Stat::create(['name' => 'Em Separação']);
        Stat::create(['name' => 'Em Transporte']);
        Stat::create(['name' => 'Entregue']);
        Stat::create(['name' => 'Cancelado']);
    }
}
