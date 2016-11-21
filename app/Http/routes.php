<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


resource('wifi-points', 'WifiPointsController');
resource('places', 'PlacesController');

function resource($uri, $controller)
{
    //$verbs = array('GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE');
    global $app;
    $app->get($uri, $controller.'@index');
    $app->get($uri.'/create', $controller.'@create');
    $app->post($uri, $controller.'@store');
    $app->get($uri.'/{id}', $controller.'@show');
    $app->get($uri.'/{id}/edit', $controller.'@edit');
    $app->put($uri.'/{id}', $controller.'@update');
    $app->patch($uri.'/{id}', $controller.'@update');
    $app->delete($uri.'/{id}', $controller.'@destroy');
}

$app->get('/crud-wifi-points', 'View\WifiPointsController@index');
$app->get('/', 'View\WifiPointsController@manageVue');
$app->get('/places', 'View\PlacesController@index');
$app->get('/places/attach/{id}', 'View\PlacesController@addWifiPoints');
$app->get('/places/sync/{id}', 'View\PlacesController@syncWifiPoints');

// create places, block A - E and floors
//$app->get('/create-places', 'View\PlacesController@createBlocksAndFloors');

