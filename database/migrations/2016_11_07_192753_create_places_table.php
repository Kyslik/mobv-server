<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("places", function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';

            $table->text("block");
            $table->integer("floor");

            $table->timestamps();
        });

        Schema::create('places_wifi_points', function (Blueprint $table) {
            $table->integer('place_id')->unsigned();
            $table->integer('wifi_point_id')->unsigned();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->primary(['place_id', 'wifi_point_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("places");
        Schema::drop("places_wifi_points");
    }
}
