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

    $router->get('users',
        ['as' => 'users.index', 'uses' => 'UsersController@index']);
    $router->post('users',
        ['as' => 'users.store', 'uses' => 'UsersController@store']);
    $router->get('users/me',
        ['as' => 'users.me', 'uses' => 'UsersController@me']);
    $router->get('users/{id}',
        ['as' => 'users.show', 'uses' => 'UsersController@show']);
    $router->patch('users/{id}',
        ['as' => 'users.update', 'uses' => 'UsersController@update']);
    $router->delete('users/{id}',
        ['as' => 'users.delete', 'uses' => 'UsersController@delete']);

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

    /*
     * Person Routes
     */
    $router->post('person',
        ['as' => 'person.store', 'uses' => 'PersonsController@store']);
    $router->post('person/type',
        ['as' => 'person.type.store', 'uses' => 'PersonTypeController@store']);
    $router->get('person/type/{id}',
        ['as' => 'person.type.show', 'uses' => 'PersonTypeController@show']);
    $router->get('person/type/{id}/list',
        ['as' => 'person.type.list', 'uses' => 'PersonTypeController@listing']);
    $router->get('person/{id}',
        ['as' => 'person.show', 'uses' => 'PersonsController@show']);
});

$router->group(['middleware' => 'camera'], function () use ($router) {
    $router->get('camera/{id}',
        ['as' => 'camera.show', 'uses' => 'CamerasController@show']);

    $router->post('reports/success',
        ['as' => 'reports.success', 'uses' => 'PositionReportsController@success']);
    $router->post('reports/unsuccessful',
        ['as' => 'reports.unsuccessful', 'uses' => 'PositionReportsController@unsuccessful']);
});
