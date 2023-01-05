# Http/BooksAndReadersController.php

public function list(Request $request)

* Получение
	$jwt_data = $request->jwt_data;
		$login = $jwt_data['login'];
		$idUser = $jwt_data['user_id'];
		
		$data = $request->input();
		$search = isset($data['search']) ? $data['search'] : '';
		$start = isset($data['start']) ? $data['start'] : 0;
		$limit = isset($data['limit']) ? $data['limit'] : 10;
		
* Возврат
	return response()->json([
		'list' => $list,
		'count' => $count,

