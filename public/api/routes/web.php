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
	
	$router->get('/books', 'BooksController@list');
	$router->post('/books', 'BooksController@add');
	$router->get('/books/{id}', 'BooksController@get');
	$router->post('/books/{id}', 'BooksController@edit');
	$router->delete('/books/{id}', 'BooksController@delete');
	
	$router->get('/account', 'AccountController@list');
	$router->post('/account', 'AccountController@add');
	$router->get('/account/{id}', 'AccountController@get');
	$router->post('/account/{id}', 'AccountController@edit');
	$router->delete('/account/{id}', 'AccountController@delete');
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	$router->get('/projects', 'ProjectsController@list');
	$router->post('/projects', 'ProjectsController@add');
	$router->get('/projects/{id}', 'ProjectsController@get');
	$router->post('/projects/{id}', 'ProjectsController@edit');
	$router->delete('/projects/{id}', 'ProjectsController@delete');
	
	$router->get('/targets', 'TargetsController@list');
	$router->post('/targets', 'TargetsController@add');
	$router->get('/targets/{id}', 'TargetsController@get');
	$router->post('/targets/{id}', 'TargetsController@edit');
	$router->delete('/targets/{id}', 'TargetsController@delete');
	
	$router->get('/document-templates', 'DocumentTemplatesController@list');
	$router->post('/document-templates', 'DocumentTemplatesController@add');
	$router->get('/document-templates/{id}', 'DocumentTemplatesController@get');
	$router->post('/document-templates/{id}', 'DocumentTemplatesController@edit');
	$router->delete('/document-templates/{id}', 'DocumentTemplatesController@delete');
	
	$router->get('/tags', 'TagsController@list');
	$router->post('/tags', 'TagsController@add');
	$router->get('/tags/{id}', 'TagsController@get');
	$router->post('/tags/{id}', 'TagsController@edit');
	$router->delete('/tags/{id}', 'TagsController@delete');
	
	$router->get('/tasks-custom-fields', 'TasksCustomFieldsController@list');
	$router->get('/tasks-custom-fields-by-tasks-type/{type_id}', 'TasksCustomFieldsController@listByTasksType');
	$router->post('/tasks-custom-fields', 'TasksCustomFieldsController@add');
	$router->get('/tasks-custom-fields/{id}', 'TasksCustomFieldsController@get');
	$router->get('/tasks-custom-fields-values/{task_id}', 'TasksCustomFieldsController@valuesByTask');
	$router->post('/tasks-custom-fields/{id}', 'TasksCustomFieldsController@edit');
	$router->delete('/tasks-custom-fields/{id}', 'TasksCustomFieldsController@delete');
	
	$router->get('/tasks-types-custom-fields-by-type/{type_id}', 'TasksTypesCustomFieldsController@listByType');
	$router->get('/tasks-types-custom-fields-by-custom-field/{custom_field_id}', 'TasksTypesCustomFieldsController@listByCustomField');
	$router->post('/tasks-types-custom-fields', 'TasksTypesCustomFieldsController@save');
	
	$router->get('/tasks-priorities', 'TasksPrioritiesController@list');
	$router->post('/tasks-priorities', 'TasksPrioritiesController@add');
	$router->get('/tasks-priorities/{id}', 'TasksPrioritiesController@get');
	$router->post('/tasks-priorities/{id}', 'TasksPrioritiesController@edit');
	$router->delete('/tasks-priorities/{id}', 'TasksPrioritiesController@delete');
	
	$router->get('/tasks-statuses', 'TasksStatusesController@list');
	$router->get('/tasks-statuses-by-tasks-type/{type_id}', 'TasksStatusesController@listByTasksType');
	$router->post('/tasks-statuses', 'TasksStatusesController@add');
	$router->get('/tasks-statuses/{id}', 'TasksStatusesController@get');
	$router->post('/tasks-statuses/{id}', 'TasksStatusesController@edit');
	$router->delete('/tasks-statuses/{id}', 'TasksStatusesController@delete');
	
	$router->get('/tasks-statuses-types', 'TasksStatusesTypesController@list');
	$router->post('/tasks-statuses-types', 'TasksStatusesTypesController@add');
	$router->get('/tasks-statuses-types/{id}', 'TasksStatusesTypesController@get');
	$router->post('/tasks-statuses-types/{id}', 'TasksStatusesTypesController@edit');
	$router->delete('/tasks-statuses-types/{id}', 'TasksStatusesTypesController@delete');
	
	$router->get('/tasks-types-statuses-by-type/{type_id}', 'TasksTypesStatusesController@listByType');
	$router->get('/tasks-types-statuses-by-status/{status_id}', 'TasksTypesStatusesController@listByStatus');
	$router->post('/tasks-types-statuses', 'TasksTypesStatusesController@save');
	
	$router->get('/tasks-types', 'TasksTypesController@list');
	$router->post('/tasks-types', 'TasksTypesController@add');
	$router->get('/tasks-types/{id}', 'TasksTypesController@get');
	$router->post('/tasks-types/{id}', 'TasksTypesController@edit');
	$router->delete('/tasks-types/{id}', 'TasksTypesController@delete');
	*/
	
	
	
	
	
	////$router->get('/mapdata', ['middleware' => 'jwt.auth', 'uses' => 'IslandsUserMapController@get']);
	//$router->get('/mapdata', 'IslandsUserMapController@get');
	////$router->post('/mapdata/move', ['middleware' => 'jwt.auth', 'uses' => 'IslandsUserMapController@move']);
	//$router->post('/mapdata/move', 'IslandsUserMapController@move');
	
	
	
	
	
	/*
	$router->get('/apikey', function() {
		return \Illuminate\Support\Str::random(32);
	});
	*/
	
	/*
	$router->get('/project/{project_id}', function ($project_id) use ($router)
	{
		$project = DB::table('cwt_projects')->where('id', $project_id)->first();
		return response()->json($project, 200);
	});
	
	$router->get('/project/{project_id}/tasks', function ($project_id) use ($router)
	{
		$tasks = DB::table('cwt_tasks')->where('project_id', $project_id)->get();
		return response()->json($tasks, 200);
	});
	
	$router->get('/documentTemplates', function () use ($router)
	{
		$document_templates = DB::table('cwt_document_templates')->get();
		return response()->json($document_templates, 200);
	});
	
	$router->get('/tasksCustomFields', function () use ($router)
	{
		$tasks_custom_fields = DB::table('cwt_tasks_custom_fields')->get();
		return response()->json($tasks_custom_fields, 200);
	});
	
	$router->get('/tasksPriorities', function () use ($router)
	{
		$tasks_priorities = DB::table('cwt_tasks_priorities')->get();
		return response()->json($tasks_priorities, 200);
	});
	
	$router->get('/tasksStatuses', function () use ($router)
	{
		$tasks_statuses = DB::table('cwt_tasks_statuses')->get();
		return response()->json($tasks_statuses, 200);
	});
	
	$router->get('/tags', function () use ($router)
	{
		$tags = DB::table('cwt_tags')->get();
		return response()->json($tags, 200);
	});
	
	$router->get('/tasksTypes', function () use ($router)
	{
		$tasks_types = DB::table('cwt_tasks_types')->get();
		return response()->json($tasks_types, 200);
	});
	*/
	
});
