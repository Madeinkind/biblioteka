<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ReadersController extends Controller
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
		$jwt_data = $request->jwt_data;
		//$login = $jwt_data['login'];
		//$idUser = $jwt_data['user_id'];
		
		/*$data = $request->input();
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
		{*/
			$count = DB::table('readers')
				->count();
			$list = DB::table('readers')
				->select('id', 'varchar')
				->where('virtualspace_id', '=', $virtualspace_id)
				->orderBy('name', 'asc')
				->limit($limit)
				->offset($start)
				->get();
		//}
		
		return response()->json([
			'list' => $list,
			'count' => $count,
		], 200);
	}
	
	/**
	 * Получение олжников книг
	 * @return	json 	Список должников книг
	 */
	public function listDebtors(Request $request)
	{
		$jwt_data = $request->jwt_data;
		//$login = $jwt_data['login'];
		//$idUser = $jwt_data['user_id'];
		
		/*$data = $request->input();
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
		{*/
			$count = DB::table('books_readers')
				->where('date_end_fact', '=', '0000-00-00 00:00:00')
				->distinct()
				->count(['reader_id']);
			$list = DB::table('books_readers')
				->select(
					'books_readers.id',
					'books_readers.reader_id',
					'readers.fio as reader_fio',
					'readers.group as reader_group',
					'readers.iin as reader_iin'
				)
				->join('readers', 'books_readers.reader_id', '=', 'readers.id')
				->where('books_readers.date_end_fact', '=', '0000-00-00 00:00:00')
				//->orderBy('name', 'asc')
				//->limit($limit)
				//->offset($start)
				->groupBy('books_readers.reader_id')
				//->toSql();
				->get();
		//}
		
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
		
		$item = DB::table('books')
			->select('id', 'namestudent', 'surnamestudent', 'bookscount', 'iin')
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
		$id = isset($data['id']) ? $data['id'] : '';
		$namestudent = isset($data['namestudent']) ? $data['namestudent'] : 1;
		$surnamestudent = isset($data['surnamestudent']) ? $data['surnamestudent'] : 1;
		$iin = isset($data['iin']) ? $data['iin'] : '';
		$bookscount = isset($data['bookscount']) ? $data['bookscount'] : '';
		
		if($name == '')
		{
			return response()->json([
				'error' => 'Ошибка при вводе данных!',
			], 400);
		}
		
		$id = DB::table('books')->insertGetId([
			//'virtualspace_id' => $virtualspace_id,
			'id' => $id,
			'namestudent' => $namestudent,
			'surnamestudent' => $surnamestudent,
			'iin' => $iin,
			'bookscount' => $bookscount,
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
		$id = isset($data['id']) ? $data['id'] : '';
		$namestudent = isset($data['namestudent']) ? $data['namestudent'] : 1;
		$surnamestudent = isset($data['surnamestudent']) ? $data['surnamestudent'] : 1;
		$iin = isset($data['iin']) ? $data['iin'] : 1;
		$bookscount = isset($data['bookscount']) ? $data['bookscount'] : 1;
		
		if($name == '')
		{
			return response()->json([
				'error' => 'Не передано Название проекта',
			], 400);
		}
		
		$success = true;
		$updateData = [
			'id' => $id,
			'namestudent' => $namestudent,
			'surnamestudent' => $surnamestudent,
			'iin' => $iin,
			'bookscount' => $bookscount,
		];
		$success = DB::table('readers')
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
		$success = DB::table('readers')
			->where('id', '=', $id)
			->delete();
		
		return response()->json([
			'success' => $success,
		], 200);
	}
}
