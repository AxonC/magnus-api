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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('camera/register',
    ['as' => 'camera.register', 'uses' => 'CamerasController@store']);
$router->get('camera/all',
    ['as' => 'camera.all', 'uses' => 'CamerasController@all']);

/*
 * Campus Routes
 */
$router->post('campus',
    ['as' => 'campus.store', 'uses' => 'CampusController@store']);
$router->get('campus/{id}/buildings',
    ['as' => 'campus.buildings', 'uses' => 'CampusController@buildings']);
$router->get('campus/{id}',
    ['as' => 'campus.show', 'uses' => 'CampusController@show']);

/*
 * Building Routes
 */
$router->get('building/{id}',
    ['as' => 'building.show', 'uses' => 'BuildingController@show']);
$router->get('building/{id}/cameras',
    ['as' => 'building.cameras', 'uses' => 'BuildingController@cameras']);
$router->post('building',
    ['as' => 'building.store', 'uses' => 'BuildingController@store']);

$router->post('login',
    ['as' => 'login', 'uses' => 'AuthenticationController@login']);

$router->group(['middleware' => 'camera'], function () use ($router) {
    $router->get('camera/{id}',
    ['as' => 'camera.show', 'uses' => 'CamerasController@show']);
});
