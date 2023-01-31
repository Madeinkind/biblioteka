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
		//$jwt_data = $request->jwt_data;
		//$login = $jwt_data['login'];
		//$idUser = $jwt_data['user_id'];
		
		$data = $request->input();
		$search = isset($data['search']) ? $data['search'] : '';
		$start = isset($data['start']) ? $data['start'] : 0;
		$limit = isset($data['limit']) ? $data['limit'] : 10;
		
		if($search != '')
		{
			$count = DB::table('books')
				->orWhere('name', 'like', '%'.$search.'%')
				->orWhere('publishing', 'like', '%'.$search.'%')
				->orWhere('about', 'like', '%'.$search.'%')
				->orWhere('inventory_number', 'like', '%'.$search.'%')
				->orWhere('year_publishing', 'like', '%'.$search.'%')
				->orWhere('author', 'like', '%'.$search.'%')
				->count();
			$list = DB::table('books')
				->orWhere('name', 'like', '%'.$search.'%')
				->orWhere('publishing', 'like', '%'.$search.'%')
				->orWhere('about', 'like', '%'.$search.'%')
				->orWhere('inventory_number', 'like', '%'.$search.'%')
				->orWhere('year_publishing', 'like', '%'.$search.'%')
				->orWhere('author', 'like', '%'.$search.'%')
				->limit($limit)
				->offset($start)
				->get();
		}
		else
		{
			$count = DB::table('books')
				->count();
			$list = DB::table('books')
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
	 * Получение выданных книг
	 * @return	json 	Данные проекта задач
	 */
	public function listIssued(Request $request)
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
				->where('books_readers.date_end_fact', '=', '0000-00-00 00:00:00')
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
				->where('books_readers.date_end_fact', '=', '0000-00-00 00:00:00')
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
				->where('date_end_fact', '=', '0000-00-00 00:00:00')
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
				->where('books_readers.date_end_fact', '=', '0000-00-00 00:00:00')
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
		//$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
		
		$item = DB::table('books')
			//->select('id', 'name')
			//->where('virtualspace_id', '=', $virtualspace_id)
			->where('id', '=', $id)
			->first();
		
		return response()->json($item, 200);
	}
	
	/**
	 * Получение выданной книги
	 * @param	$id			Integer		id проекта задач
	 * @return	json 	Данные книги
	 */
	public function getIssued($id, Request $request)
	{
		$data = $request->input();
		//$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
		
		$item = DB::table('books_readers')
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
			->where('books_readers.id', '=', $id)
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
		$name = isset($data['name']) ? $data['name'] : '';
		$count = isset($data['count']) ? $data['count'] : 1;
		$publishing = isset($data['publishing']) ? $data['publishing'] : '';
		$about = isset($data['about']) ? $data['about'] : '';
		$inventory_number = isset($data['inventory_number']) ? $data['inventory_number'] : '';
		$year_publishing = isset($data['year_publishing']) ? $data['year_publishing'] : '';
		$img = isset($data['img']) ? $data['img'] : '';
		$author = isset($data['author']) ? $data['author'] : '';
		
		if($name == '')
		{
			return response()->json([
				'error' => 'Не передано Название книги',
			], 400);
		}
		
		$id = DB::table('books')->insertGetId([
			//'virtualspace_id' => $virtualspace_id,
			'name' => $name,
			'count' => $count,
			'publishing' => $publishing,
			'about' => $about,
			'inventory_number' => $inventory_number,
			'year_publishing' => $year_publishing,
			'img' => $img,
			'author' => $author,
		]);
		
		return response()->json([
			'id' => $id,
			'success' => (bool)$id,
		], 200);
	}
	
	/**
	 * Добавление выданной книги
	 * @return	json (
	 *		id			Integer		id проекта задач
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function addIssue(Request $request)
	{
		$data = $request->input();
		//$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
		$book_id = isset($data['book_id']) ? $data['book_id'] : '';
		$reader_id = isset($data['reader_id']) ? $data['reader_id'] : '';
		$date_start = isset($data['date_start']) ? $data['date_start'] : '';
		$date_end = isset($data['date_end']) ? $data['date_end'] : '';
		
		if($book_id == '')
		{
			return response()->json([
				'error' => 'Не передан id книги',
			], 400);
		}
		
		if($reader_id == '')
		{
			return response()->json([
				'error' => 'Не передан id читателя',
			], 400);
		}
		
		if($date_start == '')
		{
			$date_start = date('Y-m-d H:i:s');
		}
		
		if($date_end == '')
		{
			return response()->json([
				'error' => 'Не передана дата планируемой сдачи',
			], 400);
		}
		
		$id = DB::table('books_readers')->insertGetId([
			//'virtualspace_id' => $virtualspace_id,
			'book_id' => $book_id,
			'reader_id' => $reader_id,
			'date_start' => $date_start,
			'date_end' => $date_end,
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
		$count = isset($data['count']) ? $data['count'] : 1;
		$publishing = isset($data['publishing']) ? $data['publishing'] : '';
		$about = isset($data['about']) ? $data['about'] : '';
		$inventory_number = isset($data['inventory_number']) ? $data['inventory_number'] : '';
		$year_publishing = isset($data['year_publishing']) ? $data['year_publishing'] : '';
		$img = isset($data['img']) ? $data['img'] : '';
		$author = isset($data['author']) ? $data['author'] : '';
		
		if($name == '')
		{
			return response()->json([
				'error' => 'Не передано Название проекта',
			], 400);
		}
		
		$success = true;
		$updateData = [
			'name' => $name,
			'count' => $count,
			'publishing' => $publishing,
			'about' => $about,
			'inventory_number' => $inventory_number,
			'year_publishing' => $year_publishing,
			'img' => $img,
			'author' => $author,
		];
		$success = DB::table('books')
			->where('id', '=', $id)
			->update($updateData);
		
		return response()->json([
			'success' => $success,
		], 200);
	}
	
	/**
	 * Изменение выданной книги
	 " @param	$id			Integer		id выдачи
	 * @return	json (
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function editIssue($id, Request $request)
	{
		$data = $request->input();
		$date_end = isset($data['date_end']) ? $data['date_end'] : '';
		
		if($date_end == '')
		{
			return response()->json([
				'error' => 'Не передана дата фактической сдачи',
			], 400);
		}
		
		$success = true;
		$updateData = [
			'date_end' => $date_end,
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
		$success = DB::table('books')
			->where('id', '=', $id)
			->delete();
		
		return response()->json([
			'success' => $success,
		], 200);
	}
	
	/**
	 * Удаление выдачи книги
	 " @param	$id			Integer		id выдачи
	 * @return	json (
	 *		success		Boolean		Статус операции
	 * )
	 */
	public function deleteIssue($id, Request $request)
	{
		$success = DB::table('books_readers')
			->where('id', '=', $id)
			->delete();
		
		return response()->json([
			'success' => $success,
		], 200);
	}
}