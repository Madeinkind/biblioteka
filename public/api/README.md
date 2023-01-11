# API
<details><summary>AuthController</summary>
<details><summary><code>GET</code> <code><b>/api/auth/checkauth</b></code> <code>(Проверка)</code></summary>

Возвращает
	
	'auth' => true,
	'token' => $jwt_string,
	'session' => $session,
	'expired' => $expired,
	'timeout' => env('JWT_COOKIE_TIMEOUT'),
	'user_data' => [
	  'id' => $user->id,
	  'login' => $user->login,
	  'sname' => $user->sname,
	  'fname' => $user->fname,
	  'lname' => $user->lname,
	  'gender' => $user->gender,
	  'email' => $user->email,
	  'tel' => $user->tel,
	  'about' => $user->about,
	  'iin' => $user->iin,
	  'avatar' => getAvatar($user->login)['fullAvaLink'],
	],
	'theme' => $user->theme,
	'lang_code' => $user->lang_code,
	'user_roles' => $user_roles,
	
</details>

<details><summary><code>POST</code> <code><b>/api/auth/login</b></code> <code>(Логин, авторизация)</code></summary>
	
Принимает
	
	$data = $request->input();
	$username = isset($data['username']) ? $data['username'] : '';
	$password = isset($data['password']) ? $data['password'] : '';
	
Возвращает
	
	'token' => $jwt_string,
	'session' => $session,
	'expired' => $expired,
	'timeout' => env('JWT_COOKIE_TIMEOUT'),
	'user_data' => [
	  'id' => $user->id,
	  'login' => $user->login, \\Логин\\
	  'sname' => $user->sname, \\sName\\
	  'fname' => $user->fname, \\fName\\
	  'lname' => $user->lname, \\lName\\
	  'gender' => $user->gender, \\пол\\
	  'email' => $user->email, \\Электронная почта\\
	  'tel' => $user->tel, \\Номер телефона\\
	  'about' => $user->about, \\автор\\
	  'iin' => $user->iin, \\ИИН\\
	  'avatar' => getAvatar($user->login)['fullAvaLink'], \\Аватарка\\
	],
	'theme' => $user->theme,
	'lang_code' => $user->lang_code,

</details>

<details><summary><code>GET</code> <code><b>/api/auth/logout</b></code> <code>(Деавторизация)</code></summary>

Возвращает
	
	'success' => true, \\Выход с аккаунта, перебрасывает на страницу входа\\

</details>
</details>

<details><summary>BooksController</summary>

<details><summary><code>GET</code> <code><b>/api/books</b></code> <code>(Книги)</code></summary>

Принимает

	$data = $request->input();

Возвращает

	'list' => $list, \\список книг\\
	'count' => $count, \\кол-во книг\\

</details>

<details><summary><code>POST</code> <code><b>/api/books</b></code> <code>(Книги)</code></summary>

Принимает

	$data = $request->input()
	$id = isset($data['id']) ? $data['id'] : '';
	$reader_id = isset($data['reader_id']) ? $data['reader_id'] : 1;
	$book_id = isset($data['book_id']) ? $data['book_id'] : 1;
	$date_start = isset($data['date_start']) ? $data['date_start'] : '';
	$date_end_plan = isset($data['date_end_plan']) ? $data['date_end_plan'] : '';
	$date_end_fact = isset($data['date_end_fact']) ? $data['date_end_fact'] : '';

Возвращает

	'id' => $id, \\\\
	'success' => (bool)$id,

</details>

<details><summary><code>GET</code> <code><b>/api/books/{id}</b></code> <code>(Книги по id)</code></summary>

Принимает

	$data = $request->input();

</details>

<details><summary><code>POST</code> <code><b>/api/books/{id}</b></code> <code>(Книги по id)</code></summary>

Принимает

	$data = $request->input();
	$name = isset($data['name']) ? $data['name'] : '';
	$count = isset($data['count']) ? $data['count'] : 1;

Возвращает

	'success' => $success,

</details>

<details><summary><code>DELETE</code> <code><b>/books/{id}</b></code> <code>(Книги по id)</code></summary>

Возвращает

	'success' => $success,

</details>

<details><summary><code>GET</code> <code><b>/</b></code> <code>(books-issued)</code></summary>

Принимает

	$data = $request->input();

Возвращает

	'list' => $list,
	'count' => $count,

</details>

<details><summary><code>POST</code> <code><b>/</b></code> <code>(books-issued)</code></summary>

Принимает

	$data = $request->input();
	$book_id = isset($data['book_id']) ? $data['book_id'] : '';
	$reader_id = isset($data['reader_id']) ? $data['reader_id'] : '';
	$date_start = isset($data['date_start']) ? $data['date_start'] : '';
	$date_end = isset($data['date_end']) ? $data['date_end'] : '';

Возвращает

	'id' => $id,
	'success' => (bool)$id,

</details>

<details><summary><code>GET</code> <code><b>/</b></code> <code>(books-issued)</code></summary>

Принимает

	$data = $request->input();

</details>

<details><summary><code>POST</code> <code><b>/</b></code> <code>(books-issued)</code></summary>

Принимает

	$data = $request->input();
	$date_end = isset($data['date_end']) ? $data['date_end'] : '';

Возвращает

	'success' => $success,

</details>

<details><summary><code>DELETE</code> <code><b>/</b></code> <code>(abooks-issued)</code></summary>

Возвращает

	'success' => $success,

</details>
</details>

<details><summary>AccountController</summary>
<details><summary><code>GET</code> <code><b>/</b></code> <code>(user)</code></summary>

Принимает

	$jwt_data = $request->jwt_data;
	$login = $jwt_data['login'];
	$idUser = $jwt_data['user_id'];
	
Возвращает

	'list' => $list,
	'count' => $count,

</details>	
<details><summary><code>POST</code> <code><b>/</b></code> <code>(user)</code></summary>

Принимает

	$data = $request->input();
	$name = isset($data['name']) ? $data['name'] : '';
	$count = isset($data['count']) ? $data['count'] : 1;
	
Возвращает

	'id' => $id, \\\\
	'success' => (bool)$id,
	
</details>

<details><summary><code>GET</code> <code><b>/</b></code> <code>(user/{id})</code></summary>

Принимает

	$data = $request->input();
	$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
	
</details>

<details><summary><code>POST</code> <code><b>/</b></code> <code>(user/{id})</code></summary>

Принимает
	
	$data = $request->input();
	$name = isset($data['username']) ? $data['username'] : '';
	$count = isset($data['id']) ? $data['id'] : 1;
	
Возвращает

	'success' => $success, \\добавление пользователя\\
	
</details>
	
<details><summary><code>DELETE</code> <code><b>/</b></code> <code>(user/{id})</code></summary>

Возвращает

	success' => $success, \\удаление пользователя по айди\\
	
</details>
</details>

<details><summary>ReadersController</summary>
<details><summary><code>GET</code> <code><b>/</b></code> <code>(readers})</code></summary>

Принимает

	$jwt_data = $request->jwt_data;
	
Возвращает

	'list' => $list, \\выдача список читателей\\
	'count' => $count, \\кол-во выданных книг\\

</details>

<details><summary><code>POST</code> <code><b>/</b></code> <code>(readers})</code></summary>

Принимает

	$data = $request->input();
	$fio = isset($data['fio']) ? $data['fio'] : '';
	$group = isset($data['group']) ? $data['group'] : '';
	$iin = isset($data['iin']) ? $data['iin'] : '';
		
Возвращает

	'id' => $id, \\айди\\
	'success' => (bool)$id, \\выдача информации\\

</details>

<details><summary><code>GET</code> <code><b>/</b></code> <code>(readers/{id})</code></summary>

Принимает

	$data = $request->input();
	$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;

</details>

<details><summary><code>POST</code> <code><b>/</b></code> <code>(readers/{id})</code></summary>

Принимает

	$data = $request->input();
	$fio = isset($data['fio']) ? $data['fio'] : '';
	$group = isset($data['group']) ? $data['group'] : '';
	$iin = isset($data['iin']) ? $data['iin'] : '';
	
Возвращает

	'success' => $success, \\информация о студенте\\
	
</details>

<details><summary><code>DELETE</code> <code><b>/</b></code> <code>(readers/{id})</code></summary>

Возвращает

	'success' => $success, \\получение id читателя\\
	
</details>

<details><summary><code>GET</code> <code><b>/</b></code> <code>(readers-debtors)</code></summary>

	$jwt_data = $request->jwt_data;
	
Возвращает

	'list' => $list, \\выдаёт список читателей должников\\
	'count' => $count, \\кол-во книг которые они не вернули\\
	
</details>

<details><summary><code>GET</code> <code><b>/</b></code> <code>(readers-debtors)</code></summary>

Принимает

	$jwt_data = $request->jwt_data;
	
Возвращает

	'list' => $list, \\выдаёт список читателей должников\\
	'count' => $count, \\кол-во книг которые они не вернули\\
	
</details>