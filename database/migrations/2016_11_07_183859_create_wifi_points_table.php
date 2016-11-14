<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWifiPointsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifi_points', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('ssid');
            $table->text('bssid');
            $table->text('capabilities')->nullable()->default(null);
            $table->text('level')->nullable()->default(null);
            $table->text('frequency')->nullable()->default(null);
            $table->text('timestamp')->nullable()->default(null);
            $table->text('distance')->nullable()->default(null);
            $table->text('distance_sd')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wifi_points');
    }
}
