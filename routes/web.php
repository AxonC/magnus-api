<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('login',
    ['as' => 'login', 'uses' => 'AuthenticationController@login']);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('test', function () use ($router) {
        return 'Working';
    });

    /*
    * Building Routes
    */
    $router->get('building/{id}',
        ['as' => 'building.show', 'uses' => 'BuildingController@show']);
    $router->get('building/{id}/cameras',
        ['as' => 'building.cameras', 'uses' => 'BuildingController@cameras']);
    $router->post('building',
        ['as' => 'building.store', 'uses' => 'BuildingController@store']);

    /*
     *  Camera routes
     */
    $router->post('camera/register',
    ['as' => 'camera.register', 'uses' => 'CamerasController@store']);
    $router->get('camera/all',
    ['as' => 'camera.all', 'uses' => 'CamerasController@all']);

    /*
     * Campus Routes
     */
    $router->get('campus',
        ['as' => 'campus.index', 'uses' => 'CampusController@index']);
    $router->post('campus',
        ['as' => 'campus.store', 'uses' => 'CampusController@store']);
    $router->get('campus/{id}/buildings',
        ['as' => 'campus.buildings', 'uses' => 'CampusController@buildings']);
    $router->get('campus/{id}',
        ['as' => 'campus.show', 'uses' => 'CampusController@show']);
});

$router->group(['middleware' => 'camera'], function () use ($router) {
    $router->get('camera/{id}',
    ['as' => 'camera.show', 'uses' => 'CamerasController@show']);
});
