<?php

$app->group(['prefix' => 'api/v1'], function (Laravel\Lumen\Application $app) {
    $app->group(['prefix' => 'locations'], function (Laravel\Lumen\Application $app) {
        $app->get('/', 'LocationController@index');
        $app->get('/{id}', 'LocationController@show');

        $app->group(['prefix' => '/{location_id}/access-points', 'middleware' => 'location'],
            function (Laravel\Lumen\Application $app) {
                $app->get('/', 'AccessPointsController@index');
                $app->get('/{id}', 'AccessPointsController@show');
                $app->post('/', 'AccessPointsController@store');
                $app->delete('/{id}', 'AccessPointsController@destroy');
            });
    });
});
