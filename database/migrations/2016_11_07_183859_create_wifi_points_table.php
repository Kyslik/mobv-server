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
        Schema::create("wifi_points", function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';

            $table->text("ssid");
            $table->text("bssid");
            $table->text("capabilities")->nullable();;
            $table->text("level")->nullable();;
            $table->text("frequency")->nullable();;
            $table->text("timestamp")->nullable();;
            $table->text("distance")->nullable();
            $table->text("distanceSd")->nullable();

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
        Schema::drop("wifi_points");
    }
}
