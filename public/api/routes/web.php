<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

//$router->group(['prefix' => 'api', 'middleware' => 'jwt.auth'], function () use ($router)
$router->group(['prefix' => ''], function () use ($router)
{
	$router->get('/', function () use ($router)
	{
		//return $router->app->version();
		return redirect('/', 301);
	});
	
	$router->get('/auth/checkauth', 'AuthController@checkauth'); // проверка авторизованности
	$router->post('/auth/login', 'AuthController@login'); // авторизация
	$router->get('/auth/logout', 'AuthController@logout'); // деавторизация
	
	$router->get('/books', 'BooksController@list'); // получение списка всех книг
	$router->post('/books', 'BooksController@add'); // добавление книги
	$router->get('/books/{id}', 'BooksController@get'); // получение книги по ее id
	$router->post('/books/{id}', 'BooksController@edit'); // изменение книги по ее id
	$router->delete('/books/{id}', 'BooksController@delete'); // удаление книги по ее id
	$router->get('/books-issued', 'BooksController@listIssued'); // получение списка выданных книг
	$router->post('/books-issued', 'BooksController@addIssue'); // выдача книги
	$router->get('/books-issued/{id}', 'BooksController@getIssued'); // получение выданной книги по ее id
	$router->post('/books-issued/{id}', 'BooksController@editIssue'); // изменение выданной книги по ее id
	$router->delete('/books-issued/{id}', 'BooksController@deleteIssue'); // удаление выдачи по ее id
	
	$router->get('/user', 'AccountController@list'); // получение списка всех пользователей
	$router->post('/user', 'AccountController@add'); // добавление пользователя
	$router->get('/user/{id}', 'AccountController@get'); // получение айди пользователя
	$router->post('/user/{id}', 'AccountController@edit'); // изменение по айди
	$router->delete('/user/{id}', 'AccountController@delete'); // удаление пользователя
	
	$router->get('/readers', 'ReadersController@list'); // получение списка всех студентов
	$router->post('/readers', 'ReadersController@add');  // добавление данных студента
	$router->get('/readers/{id}', 'ReadersController@get');  // получение читателя по его id
	$router->post('/readers/{id}', 'ReadersController@edit'); // изменение данных студента по айди 
	$router->delete('/readers/{id}', 'ReadersController@delete'); // удаление студента из базы
	$router->get('/readers-debtors', 'ReadersController@listDebtors'); // получение списка должников
	$router->get('/readers-debtors/{id}', 'ReadersController@getDebtor');  // получение должника по его id
	
	$router->get('/books-readers', 'BooksAndReadersController@list');  // список выданных книг
	$router->post('/books-readers', 'BooksAndReadersController@release');  // выдача книги
	$router->post('/books-readers/{id}', 'BooksAndReadersController@return');  // возврат книги
	
	$router->get('/auth/checkauth', 'AuthController@checkauth'); // проверка авторизованности
	$router->post('/auth/login', 'AuthController@login');
	$router->get('/auth/logout', 'AuthController@logout');
	
	$router->get('/visitors', 'VisitorsController@list'); // получение списка всех посетителей
	$router->post('/visitors', 'VisitorsController@add'); // добавление посетителя
	$router->get('/visitors/{id}', 'VisitorsController@get'); // получение посетителя по его id
	$router->post('/visitors/{id}', 'VisitorsController@edit'); // изменение посетителя по ее id
	$router->delete('/visitors/{id}', 'VisitorsController@delete'); // удаление пользователя по ее id
});
