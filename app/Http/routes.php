<?php

$app->group(['prefix' => 'api/v1'], function (Laravel\Lumen\Application $app) {
    $app->group(['prefix' => 'locations'], function () use ($app) {
        $app->get('/', 'LocationController@index');
        $app->get('/{id}', 'LocationController@show');
        $app->post('/find', ['middleware' => 'json', 'uses' => 'LocationController@find']);

        $app->group(['prefix' => '/{location_id}/access-points', 'middleware' => 'location-exists'], function () use ($app) {
            $app->get('/', 'AccessPointsController@index');
            $app->get('/{id}', 'AccessPointsController@show');
            $app->post('/', ['middleware' => 'json', 'uses' => 'AccessPointsController@store']);
            $app->delete('/{id}', 'AccessPointsController@destroy');
        });
    });
});
