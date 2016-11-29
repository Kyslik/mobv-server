<?php

use Illuminate\Database\Seeder;

class AccessPointsRandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AccessPoint::class, 1000)->create();
    }
}
