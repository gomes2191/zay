<?php

use App\Core\App;

//Se a opção de configuração de rotas de notação de matriz em config.php estiver definida como true, vamos usar o roteamento de notação de matriz.
if (App::get('config')['options']['array_routing']) {
    $router->getArray([
        '' => 'PagesController@home',
        'about' => 'PagesController@about',
        'contact' => 'PagesController@contact',
        'users' => 'UsersController@index',
        'users/{page}' => 'UsersController@index',
        'user/{id}' => 'UsersController@show',
        'user/delete/{id}' => 'UsersController@delete',
    ]);
    $router->postArray([
        'users' => 'UsersController@store',
        'user/update/{id}' => 'UsersController@update',
    ]);
} else {
    $router->get('', 'PagesController@home');
    $router->get('about', 'PagesController@about');
    $router->get('contact', 'PagesController@contact');

    $router->get('users', 'UsersController@index');
    $router->get('users/{page}', 'UsersController@index');
    $router->get('user/{id}', 'UsersController@show');
    $router->get('user/delete/{id}', 'UsersController@delete');
    $router->post('users', 'UsersController@store');
    $router->post('user/update/{id}', 'UsersController@update');
}
