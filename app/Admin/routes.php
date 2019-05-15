<?php

use App\Admin\Controllers\NewsController;
use App\Admin\Controllers\CathedraInfoController;
use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/news', 'NewsController');
    $router->resource('/news-category', 'NewsCategoryController');
    $router->resource('/news-tags', 'NewsTagController');
    $router->resource('/albums', 'AlbumController');
    $router->resource('/events', 'EventController');
    $router->resource('/cathedra-users', 'CathedraUsersController');
    $router->resource('/groups', 'GroupsController');

    $router->resource('/bachelor', 'BachelorController');
    $router->resource('/bachelor-accelerated', 'BachelorАcceleratedController');
    $router->resource('/master', 'MasterController');
    $router->resource('/postgraduate', 'PostgraduateController');

    $router->resource('/telegram-bot/mailing/list', 'MailController');
    $router->resource('/telegram-bot/applicants/cathedra', 'CathedraInfoControllers');

    $router->get('/telegram-bot/mailing/mail', 'TelegramBotController@index');

    
});
