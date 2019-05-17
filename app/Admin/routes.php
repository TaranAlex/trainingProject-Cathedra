<?php

use App\Admin\Controllers\NewsController;
use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', ' HomeController@index');
    $router->resource('/news', 'NewsController');
    $router->resource('/news-category', 'NewsCategoryController');
    $router->resource('/news-tags', 'NewsTagController');
    $router->resource('/albums', 'AlbumController');
    $router->resource('/events', 'EventController');
    $router->resource('/cathedra-users', 'CathedraUsersController');
    $router->resource('/groups', 'GroupsController');
    $router->resource('/cathedras', 'CathedraController');
    $router->resource('/teachers', 'TeacherController');
    $router->resource('/shedules', 'SheduleController');
    $router->resource('/items', 'ItemController');
    $router->resource('/students', 'StudentController');
    $router->resource('/online_journals', 'Online_journalController');
    //$router->resource('/checkpoints', 'CheckPointController');

    $router->get('/journals/{id}', 'JournalController@index')->name('journal');
    $router->post('/checkpoints', 'CheckPointController@store')->name('checkpoints');
    $router->get('/checkpoints/{id}/edit', 'CheckPointController@edit');
    $router->post('/checkpoints/update/{id}', 'CheckPointController@update')->name('checkpoints_update');
    $router->get('/checkpoints/delete/{id}', 'CheckPointController@destroy');
    $router->post('/student_points', 'StudentPointController@update');
    $router->get('/telegram-bot', 'TelegramBotController@index');
});