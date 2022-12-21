<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BooksController extends Controller
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
		$login = $jwt_data['login'];
		$idUser = $jwt_data['user_id'];
		
		$data = $request->input();
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
			$count = DB::table('books_readers')
				->count();
			$list = DB::table('books_readers')
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
	 * Получение проекта задач
	 " @param	$id			Integer		id проекта задач
	 * @return	json 	Данные проекта задач
	 */
	public function get($id, Request $request)
	{
		$data = $request->input();
		$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
		
		$item = DB::table('books')
			->select('id', 'reader_id', 'book_id', 'date_start', 'date_end_plan','date_end_fact')
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
		$reader_id = isset($data['reader_id']) ? $data['reader_id'] : 1;
		$book_id = isset($data['book_id']) ? $data['book_id'] : 1;
		$date_start = isset($data['date_start']) ? $data['date_start'] : '';
		$date_end_plan = isset($data['date_end_plan']) ? $data['date_end_plan'] : '';
		$date_end_fact = isset($data['date_end_fact']) ? $data['date_end_fact'] : '';
		
		if($name == '')
		{
			return response()->json([
				'error' => 'Ошибка при вводе данных!',
			], 400);
		}
		
		$id = DB::table('books_readers')->insertGetId([
			//'virtualspace_id' => $virtualspace_id,
			'id' => $id,
			'reader_id' => $reader_id,
			'book_id' => $book_id,
			'date_start' => $date_start,
			'date_end_plan' => $date_end_plan,
			'date_end_factt' => $date_end_fact,
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
		$reader_id = isset($data['reader_id']) ? $data['reader_id'] : 1;
		$book_id = isset($data['book_id']) ? $data['book_id'] : 1;
		$date_start = isset($data['date_start']) ? $data['date_start'] : 1;
		$date_end_plan = isset($data['date_end_plan']) ? $data['date_end_plan'] : 1;
		$bookscount = isset($data['date_end_fact']) ? $data['date_end_fact'] : 1;
		
		if($name == '')
		{
			return response()->json([
				'error' => 'Ошибка',
			], 400);
		}
		
		$success = true;
		$updateData = [
			'id' => $id,
			'reader_id' => $reader_id,
			'book_id' => $book_id,
			'date_start' => $date_start,
			'date_end_plan' => $date_end_plan,
			'date_end_fact' => $date_end_fact,
		];
		$success = DB::table('books_readers')
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
} 5