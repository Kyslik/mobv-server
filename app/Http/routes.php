<?php

$app->group(['prefix' => 'api/v1'], function(Laravel\Lumen\Application $app)
{
    $app->get('wifi-points', 'WifiPointsController@index');
    $app->post('wifi-points', 'WifiPointsController@store');
    $app->get('wifi-points/{id}', 'WifiPointsController@show');
    $app->put('wifi-points/{id}', 'WifiPointsController@update');
    $app->patch('wifi-points/{id}', 'WifiPointsController@update');
    $app->delete('wifi-points/{id}', 'WifiPointsController@destroy');

    $app->get('places', 'PlacesController@index');
    $app->post('places', 'PlacesController@store');
    $app->get('places/{id}', 'PlacesController@show');
    $app->put('places/{id}', 'PlacesController@update');
    $app->patch('places/{id}', 'PlacesController@update');
    $app->delete('places/{id}', 'PlacesController@destroy');
});

$app->get('/crud-wifi-points', 'View\WifiPointsController@index');
$app->get('/', 'View\WifiPointsController@manageVue');
