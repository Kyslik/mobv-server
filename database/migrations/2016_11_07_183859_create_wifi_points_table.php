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
            // https://developer.android.com/reference/android/net/wifi/ScanResult.html
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('bssid', 17);
            $table->string('ssid')->nullable()->default(null);
            $table->text('capabilities')->nullable()->default(null);
            $table->integer('level')->nullable()->default(null);
            $table->integer('frequency')->nullable()->default(null);
            $table->string('timestamp', 64)->nullable()->default(null);
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
