<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('jwt.auth');
    }
	
	/**
	 * Получение проектов задач
	 * @return	json 	Список проектов задач
	 */
	public function list(Request $request)
	{
		//$jwt_data = $request->jwt_data;
		//$login = $jwt_data['login'];
		//$idUser = $jwt_data['user_id'];
		
		$data = $request->input();
		$virtualspace_id = isset($_GET['virtualspace_id']) ? $_GET['virtualspace_id'] : null;
		$search = isset($data['search']) ? $data['search'] : '';
		$start = isset($data['start']) ? $data['start'] : 0;
		$limit = isset($data['limit']) ? $data['limit'] : 10;
		
		if($search != '')
		{
			$count = DB::table('cwt_projects')
				->where('virtualspace_id', '=', $virtualspace_id)
				->where('name', 'like', '%'.$search.'%')
				->count();
			$list = DB::table('cwt_projects')
				->select('id', 'name')
				->where('virtualspace_id', '=', $virtualspace_id)
				->where('name', 'like', '%'.$search.'%')
				->limit($limit)
				->offset($start)
				->orderBy('name', 'asc')
				->get();
		}
		else
		{
			$count = DB::table('cwt_projects')
				->where('virtualspace_id', '=', $virtualspace_id)
				->count();
			$list = DB::table('cwt_projects')
				->select('id', 'name')
				->where('virtualspace_id', '=', $virtualspace_id)
				->orderBy('name', 'asc')
				->limit($limit)
				->offset($start)
				->get();
		}
		
		return response()->json([
			'list' => $list,
			'count' => $count,
		], 200);
	}
	
	/**
	 * Получение проекта задач
	 " @param	$id			Integer		id проекта задач
	 * @return	json 	Данные проекта задач
	 */
	public function get($id, Request $request)
	{
		$data = $request->input();
		$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
		
		$item = DB::table('cwt_projects')
			->select('id', 'name')
			->where('virtualspace_id', '=', $virtualspace_id)
			->where('id', '=', $id)
			->first();
		
		return response()->json($item, 200);
	}
	
	/**
	 * Добавление проекта задач
	 * @return	json (
	 *		id			Integer		id проекта задач
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function add(Request $request)
	{
		$data = $request->input();
		$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
		$name = isset($data['name']) ? $data['name'] : '';
		
		if($name == '')
		{
			return response()->json([
				'error' => 'Не передано Название проекта',
			], 400);
		}
		
		$id = DB::table('cwt_projects')->insertGetId([
			'virtualspace_id' => $virtualspace_id,
			'name' => $name,
		]);
		
		return response()->json([
			'id' => $id,
			'success' => (bool)$id,
		], 200);
	}
	
	/**
	 * Изменение проекта задач
	 " @param	$id			Integer		id проекта задач
	 * @return	json (
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function edit($id, Request $request)
	{
		$data = $request->input();
		$name = isset($data['name']) ? $data['name'] : '';
		
		if($name == '')
		{
			return response()->json([
				'error' => 'Не передано Название проекта',
			], 400);
		}
		
		$success = true;
		$updateData = [
			'name' => $name,
		];
		$success = DB::table('cwt_projects')
			->where('id', '=', $id)
			->update($updateData);
		
		return response()->json([
			'success' => $success,
		], 200);
	}
	
	/**
	 * Удаление проекта задач
	 " @param	$id			Integer		id проекта задач
	 * @return	json (
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function delete($id, Request $request)
	{
		$success = DB::table('cwt_projects')
			->where('id', '=', $id)
			->delete();
		
		return response()->json([
			'success' => $success,
		], 200);
	}
}
