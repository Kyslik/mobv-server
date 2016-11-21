<?php

$app->group(['prefix' => 'api/v1'], function (Laravel\Lumen\Application $app) {
    $app->get('wifi-points', 'WifiPointsController@index');
    $app->post('wifi-points', 'WifiPointsController@store');
    $app->get('wifi-points/{id}', 'WifiPointsController@show');
    $app->put('wifi-points/{id}', 'WifiPointsController@update');
    $app->patch('wifi-points/{id}', 'WifiPointsController@update');
    $app->delete('wifi-points/{id}', 'WifiPointsController@destroy');

    $app->group(['prefix' => 'places'], function (Laravel\Lumen\Application $app) {
        $app->get('/', 'PlacesController@index');
        $app->post('/', 'PlacesController@store');
        $app->get('/{id}', 'PlacesController@show');
        $app->put('/{id}', 'PlacesController@update');
        $app->patch('/{id}', 'PlacesController@update');
        $app->delete('/{id}', 'PlacesController@destroy');

        $app->post('/{id}/sync', 'PlacesController@sync');

        $app->group(['prefix' => '{place_id}/wifi-points'], function (Laravel\Lumen\Application $app) {
            $app->get('/', 'PlacesWifiPointsController@index');
            $app->post('/', 'PlacesWifiPointsController@store');
            $app->get('/{id}', 'PlacesWifiPointsController@show');
            $app->put('/{id}', 'PlacesWifiPointsController@update');
            $app->patch('/{id}', 'PlacesWifiPointsController@update');
            $app->delete('/{id}', 'PlacesWifiPointsController@destroy');
            $app->post('/{id}/attach', 'PlacesController@attach');
            $app->post('/{id}/detach', 'PlacesController@detach');
        });
    });
});

$app->get('/crud-wifi-points', 'View\WifiPointsController@index');
$app->get('/', 'View\WifiPointsController@manageVue');

$app->get('/places', 'View\PlacesController@index');
$app->get('/places/attach/{id}', 'View\PlacesController@addWifiPoints');
$app->get('/places/sync/{id}', 'View\PlacesController@syncWifiPoints');

//deployment push
//deployment push
//deployment push
//deployment push
// create places, block A - E and floors
//$app->get('/create-places', 'View\PlacesController@createBlocksAndFloors');
