<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BooksAndReadersController extends Controller
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
	 * Получение проекта задач
	 " @param	$id			Integer		id проекта задач
	 * @return	json 	Данные проекта задач
	 */
	public function get($id, Request $request)
	{
		$data = $request->input();
		//$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
		
		$item = DB::table('books')
			->select('id', 'reader_id', 'book_id', 'date_start', 'date_end_plan','date_end_fact')
			//->where('virtualspace_id', '=', $virtualspace_id)
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
		//$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
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
	 * Удаление книги
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
	
	/*
	 * Выдача книги
	 * @return	json (
	 *		id			Integer		id записи в истории
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function release(Request $request)
	{
		$data = $request->input();
		$reader_id = isset($data['reader_id']) ? $data['reader_id'] : null;
		$book_id = isset($data['book_id']) ? $data['book_id'] : null;
		$date_start = isset($data['date_start']) ? $data['date_start'] : null;
		$date_end_plan = isset($data['date_end_plan']) ? $data['date_end_plan'] : null;
		
		if(!$reader_id)
		{
			return response()->json([
				'error' => 'Не указан id читателя',
			], 400);
		}
		if(!$book_id)
		{
			return response()->json([
				'error' => 'Не указан id книги',
			], 400);
		}
		if(!$date_start)
		{
			return response()->json([
				'error' => 'Не указана дата выдачи книги',
			], 400);
		}
		if(!$date_end_plan)
		{
			return response()->json([
				'error' => 'Не указана дата планируемого возврата книги',
			], 400);
		}
		
		$id = DB::table('books_readers')->insertGetId([
			'reader_id' => $reader_id,
			'book_id' => $book_id,
			'date_start' => $date_start,
			'date_end_plan' => $date_end_plan,
		]);
		
		return response()->json([
			'id' => $id,
			'success' => (bool)$id,
		], 200);
	}
	
	/*
	 * Возврат книги
	 * @param	$id			Integer		id записи в истории
	 * @return	json (
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function return($id, Request $request)
	{
		$data = $request->input();
		$date_end_fact = isset($data['date_end_fact']) ? $data['date_end_fact'] : null;
		
		if(!$date_end_fact)
		{
			return response()->json([
				'error' => 'Не указана дата фактического возврата книги',
			], 400);
		}
		
		$success = true;
		$updateData = [
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
	 * Получение истории выданных книг
	 * @return	json 	Данные проекта задач
	 */
	public function list(Request $request)
	{
		//$jwt_data = $request->jwt_data;
		//$login = $jwt_data['login'];
		//$idUser = $jwt_data['user_id'];
		
		$data = $request->input();
		$search = isset($data['search']) ? $data['search'] : '';
		$start = isset($data['start']) ? $data['start'] : 0;
		$limit = isset($data['limit']) ? $data['limit'] : 10;
		
		if($search != '')
		{
			$count = DB::table('books_readers')
				->select(
					'books_readers.id as id',
					'books_readers.reader_id',
					'books_readers.book_id',
					'books_readers.date_start',
					'books_readers.date_end_plan',
					'books_readers.date_end_fact',
					'books.name as book_name',
					'books.publishing as book_publishing',
					'readers.fio as reader_fio',
					'readers.group as reader_group',
					'readers.iin as reader_iin'
				)
				->join('books', 'books_readers.book_id', '=', 'books.id')
				->join('readers', 'books_readers.reader_id', '=', 'readers.id')
				->where(function ($query) use ($search){
					$query
						->orWhere('books.name', 'like', '%'.$search.'%')
						->orWhere('books.publishing', 'like', '%'.$search.'%')
						->orWhere('readers.fio', 'like', '%'.$search.'%')
						->orWhere('readers.group', 'like', '%'.$search.'%')
						->orWhere('readers.iin', 'like', '%'.$search.'%');
				})
				->count();
			$list = DB::table('books_readers')
				->select(
					'books_readers.id as id',
					'books_readers.reader_id',
					'books_readers.book_id',
					'books_readers.date_start',
					'books_readers.date_end_plan',
					'books_readers.date_end_fact',
					'books.name as book_name',
					'books.publishing as book_publishing',
					'readers.fio as reader_fio',
					'readers.group as reader_group',
					'readers.iin as reader_iin'
				)
				->join('books', 'books_readers.book_id', '=', 'books.id')
				->join('readers', 'books_readers.reader_id', '=', 'readers.id')
				->where(function ($query) use ($search){
					$query
						->orWhere('books.name', 'like', '%'.$search.'%')
						->orWhere('books.publishing', 'like', '%'.$search.'%')
						->orWhere('readers.fio', 'like', '%'.$search.'%')
						->orWhere('readers.group', 'like', '%'.$search.'%')
						->orWhere('readers.iin', 'like', '%'.$search.'%');
				})
				->get();
		}
		else
		{
			$count = DB::table('books_readers')
				->count();
			$list = DB::table('books_readers')
				->select(
					'books_readers.id as id',
					'books_readers.reader_id',
					'books_readers.book_id',
					'books_readers.date_start',
					'books_readers.date_end_plan',
					'books_readers.date_end_fact',
					'books.name as book_name',
					'books.publishing as book_publishing',
					'readers.fio as reader_fio',
					'readers.group as reader_group',
					'readers.iin as reader_iin'
				)
				->join('books', 'books_readers.book_id', '=', 'books.id')
				->join('readers', 'books_readers.reader_id', '=', 'readers.id')
				->get();
		}
		
		return response()->json([
			'list' => $list,
			'count' => $count,
		], 200);
	}
}