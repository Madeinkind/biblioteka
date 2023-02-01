<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
	
	/**
	 * Получение проектов задач
	 * @return	json 	Список проектов задач
	 */
	public function list(Request $request)
	{
		$data = $request->input();
		$search = isset($data['search']) ? $data['search'] : '';
		$start = isset($data['start']) ? $data['start'] : 0;
		$limit = isset($data['limit']) ? $data['limit'] : 10;
		
		if($search != '')
		{
			$count = DB::table('visitors')
				->orWhere('fio', 'like', '%'.$search.'%')
				->orWhere('group', 'like', '%'.$search.'%')
				->orWhere('date', 'like', '%'.$search.'%')
				->count();
			$list = DB::table('visitors')
				->orWhere('fio', 'like', '%'.$search.'%')
				->orWhere('group', 'like', '%'.$search.'%')
				->orWhere('date', 'like', '%'.$search.'%')
				->limit($limit)
				->offset($start)
				->get();
		}
		else
		{
			$count = DB::table('visitors')
				->count();
			$list = DB::table('visitors')
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
	 * @param	$id			Integer		id проекта задач
	 * @return	json 	Данные проекта задач
	 */
	public function get($id, Request $request)
	{
		$data = $request->input();
		
		$item = DB::table('visitors')
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
		$fio = isset($data['fio']) ? $data['fio'] : '';
		$group = isset($data['group']) ? $data['group'] : '';
		$date = isset($data['date']) ? $data['date'] : '';
		
		if($fio == '')
		{
			return response()->json([
				'error' => 'Не передано ФИО',
			], 400);
		}
		
		$id = DB::table('visitors')->insertGetId([
			'fio' => $fio,
			'group' => $group,
			'date' => $date,
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
		$fio = isset($data['fio']) ? $data['fio'] : '';
		$group = isset($data['group']) ? $data['group'] : '';
		$date = isset($data['date']) ? $data['date'] : '';
		
		if($fio == '')
		{
			return response()->json([
				'error' => 'Не передано ФИО',
			], 400);
		}
		
		$item = DB::table('visitors')
			->where('id', '=', $id)
			->first();
		$img = '';
		
		$success = true;
		$updateData = [
			'fio' => $fio,
			'group' => $group,
			'date' => $date,
		];
		$success = DB::table('visitors')
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
		$success = DB::table('books')
			->where('id', '=', $id)
			->delete();
		
		return response()->json([
			'success' => $success,
		], 200);
	}
	
}