<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenamePlaceWifiPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('places_wifi_points', 'place_wifi_point');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('place_wifi_point', 'places_wifi_points');
    }
}
