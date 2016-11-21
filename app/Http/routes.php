<?php
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

$app->get('bugsnag', function(){
    Bugsnag::notifyError('ErrorType', 'Test Error');
});

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

$app->get('/places', 'View\PlacesController@index');
$app->get('/places/attach/{id}', 'View\PlacesController@addWifiPoints');
$app->get('/places/sync/{id}', 'View\PlacesController@syncWifiPoints');

// create places, block A - E and floors
//$app->get('/create-places', 'View\PlacesController@createBlocksAndFloors');

