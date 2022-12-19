<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class TagsController extends Controller
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
	 * Получение тегов задач
	 * @return	json 	Список тегов задач
	 */
	public function list(Request $request)
	{
		//$jwt_data = $request->jwt_data;
		//$login = $jwt_data['login'];
		//$idUser = $jwt_data['user_id'];
		
		$data = $request->input();
		$virtualspace_id = isset($_GET['virtualspace_id']) ? $_GET['virtualspace_id'] : null;
		
		$count = DB::table('cwt_tags')
			->where('virtualspace_id', '=', $virtualspace_id)
			->count();
		$list = DB::table('cwt_tags')
			->select('id', 'name')
			->where('virtualspace_id', '=', $virtualspace_id)
			->orderBy('name', 'asc')
			->get();
		
		return response()->json([
			'list' => $list,
			'count' => $count,
		], 200);
	}
	
	/**
	 * Получение тега задач
	 " @param	$id			Integer		id тега задач
	 * @return	json 	Данные тега задач
	 */
	public function get($id, Request $request)
	{
		$item = DB::table('cwt_tags')
			->select('id', 'name')
			->where('id', '=', $id)
			->first();
		
		return response()->json($item, 200);
	}
	
	/**
	 * Добавление тега задач
	 * @return	json (
	 *		id			Integer		id тега задач
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
				'error' => 'Не передано Название тега',
			], 400);
		}
		
		$id = DB::table('cwt_tags')->insertGetId([
			'virtualspace_id' => $virtualspace_id,
			'name' => $name,
		]);
		
		return response()->json([
			'id' => $id,
			'success' => (bool)$id,
		], 200);
	}
	
	/**
	 * Изменение тега задач
	 " @param	$id			Integer		id тега задач
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
				'error' => 'Не передано Название тега',
			], 400);
		}
		
		$success = true;
		$updateData = [
			'name' => $name,
		];
		$success = DB::table('cwt_tags')
			->where('id', '=', $id)
			->update($updateData);
		
		return response()->json([
			'success' => $success,
		], 200);
	}
	
	/**
	 * Удаление тега задач
	 " @param	$id			Integer		id тега задач
	 * @return	json (
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function delete($id, Request $request)
	{
		$success = DB::table('cwt_tags')
			->where('id', '=', $id)
			->delete();
		
		return response()->json([
			'success' => $success,
		], 200);
	}
}
