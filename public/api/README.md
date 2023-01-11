# API
<details><summary>AuthController</summary>
<details><summary><code>GET</code> <code><b>/api/auth/checkauth</b></code> <code>(Проверка)</code></summary>

Возвращает
	
	'auth' => true,
	'token' => 'xsfsgrddgrge454etre6ytgrfy45',
	'session' => '35435trdgd5ed4trt4g',
	'expired' => 86400,
	'timeout' => 86400,
	'user_data' => [
	  'id' => 1,
	  'login' => 'user', //имя//
	  'sname' => 'ivanov', // фамилия //
	  'fname' => 'ivan', //имя//
	  'lname' => 'ivanich', //отчество//
	  'gender' => 1,
	  'email' => 'user@example.com',
	  'tel' => '87011234567',
	  'about' => 'i am proger',
	  'iin' => '123456789012',
	  'avatar' => 'img.png',
	],
	
</details>

<details><summary><code>POST</code> <code><b>/api/auth/login</b></code> <code>(Логин, авторизация)</code></summary>
	
Принимает
	
	$data = $request->input();
	$username = 'login' //имя//
	$password = 'qwerty12345' //пароль//
	
Возвращает
	
	'token' => 'xsfsgrddgrge454etre6ytgrfy45',
	'session' => '35435trdgd5ed4trt4g',
	'expired' => 86400,
	'timeout' => 86400,
	'user_data' =>  [
	  'id' => 1,
	  'login' => 'user', //имя//
	  'sname' => 'ivanov', // фамилия //
	  'fname' => 'ivan', //имя//
	  'lname' => 'ivanich', //отчество//
	  'gender' => 1,
	  'email' => 'user@example.com',
	  'tel' => '87011234567',
	  'about' => 'i am proger',
	  'iin' => '123456789012',
	  'avatar' => 'img.png', \\Аватарка\\
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

	$id => '21312312' //айди записи//
	$reader_id => '2121312312' //айди читателя//
	$book_id => '21312321' //айди книги//
	$date_start => '1 января 2025' //дата выдачи//
	$date_end_plan => '10 января 2026' //дата возвращения//
	$date_end_fact => '15 января 2026' //дата возвращения по факту//

Возвращает

{"list":[{"id":3,"name":"dsadsa","count":1,"publishing":""},{"id":4,"name":"dsadsa","count":1,"publishing":""},{"id":5,"name":"dsadsa","count":1,"publishing":""},{"id":6,"name":"dsadsa","count":1,"publishing":""},{"id":7,"name":"dsadsa","count":1,"publishing":""},{"id":8,"name":"dsadsa","count":1,"publishing":""}],"count":6}

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

<details><summary><code>GET</code> <code><b>/api/books-issued</b></code> <code>(Выдача книг)</code></summary>

Принимает

	$data = $request->input();

Возвращает

	'list' => $list,
	'count' => $count,

</details>

<details><summary><code>POST</code> <code><b>/api/books-issued</b></code> <code>(POST параметр Выдача Книги)</code></summary>

Принимает

	$book_id = '32432432';
	$reader_id = '423432432';
	$date_start = '1 января 2025';
	$date_end = '15 января 2026';

Возвращает

	'id' => 1,
	'success' => true,

</details>

<details><summary><code>GET</code> <code><b>/api/books-issued</b></code> <code>(Выдача Книги)</code></summary>

Принимает

	$data = $request->input();

</details>

<details><summary><code>POST</code> <code><b>/api/books-issued</b></code> <code>(POST параметр выдача Книги)</code></summary>

Принимает

	$date_end = '15 января 2026';

Возвращает

	'success' => $success,

</details>

<details><summary><code>DELETE</code> <code><b>/api/books-issued</b></code> <code>(Удаление выданной книги)</code></summary>

Возвращает

	'success' => $success,

</details>
</details>

<details><summary>AccountController</summary>
<details><summary><code>GET</code> <code><b>/api/user</b></code> <code>(Пользователь)</code></summary>

Принимает

	$login = 'Логин'
	$idUser = 'Айди Пользователя'
	
Возвращает

	'list' => $list,
	'count' => $count,

</details>	
<details><summary><code>POST</code> <code><b>/api/user</b></code> <code>(POST параметр Пользователя)</code></summary>

Принимает

	$name = 'ivan'
	$count = '2';
	
Возвращает

	'id' => $id, \\\\
	'success' => (bool)$id,
	
</details>

<details><summary><code>GET</code> <code><b>/api/user{id}</b></code> <code>(Пользователь по id)</code></summary>

Принимает

	$data = $request->input();
	$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;
	
</details>

<details><summary><code>POST</code> <code><b>/api/user{id}</b></code> <code>(POST параметр Пользователя по id)</code></summary>

Принимает
	
	$name => 'ivan';
	$count => 1;
	
Возвращает

	'success' => $success, \\добавление пользователя\\
	
</details>
	
<details><summary><code>DELETE</code> <code><b>/api/user{id}</b></code> <code>(Удаление Пользователя по id)</code></summary>

Возвращает

	success' => $success, \\удаление пользователя по айди\\
	
</details>
</details>

<details><summary>ReadersController</summary>
<details><summary><code>GET</code> <code><b>/api/readers</b></code> <code>(Читатели)</code></summary>

Принимает

	$jwt_data = $request->jwt_data;
	
Возвращает

	'list' => $list, \\выдача список читателей\\
	'count' => $count, \\кол-во выданных книг\\

</details>

<details><summary><code>POST</code> <code><b>/api/readers</b></code> <code>(Читатели)</code></summary>

Принимает

	$data = $request->input();
	$fio = isset($data['fio']) ? $data['fio'] : '';
	$group = isset($data['group']) ? $data['group'] : '';
	$iin = isset($data['iin']) ? $data['iin'] : '';
		
Возвращает

	'id' => $id, \\айди\\
	'success' => (bool)$id, \\выдача информации\\

</details>

<details><summary><code>GET</code> <code><b>/api/readers/{id}</b></code> <code>(Читатель по id)</code></summary>

Принимает

	$data = $request->input();
	$virtualspace_id = isset($data['virtualspace_id']) ? $data['virtualspace_id'] : null;

</details>

<details><summary><code>POST</code> <code><b>/api/readers/{id}</b></code> <code>(POST параметр Читатель по id)</code></summary>

Принимает

	$fio => 'ivanov ivan ivanich'
	$group => 'POb-42';
	$iin => '123456789012';
	
Возвращает

	'success' => $success, \\информация о студенте\\
	
</details>

<details><summary><code>DELETE</code> <code><b>/api/readers/{id}</b></code> <code>(Удаление Читателя по id)</code></summary>

Возвращает

	'success' => $success, \\получение id читателя\\
	
</details>

<details><summary><code>GET</code> <code><b>/api/readers-debtors</b></code> <code>(Читатели должники)</code></summary>

	$jwt_data = $request->jwt_data;
	
Возвращает

	'list' => $list, \\выдаёт список читателей должников\\
	'count' => $count, \\кол-во книг которые они не вернули\\
	
</details>

<details><summary><code>GET</code> <code><b>/api/readers-debtors</b></code> <code>(Читатели должники)</code></summary>

Принимает

	$jwt_data = $request->jwt_data;
	
Возвращает

	'list' => $list, \\выдаёт список читателей должников\\
	'count' => $count, \\кол-во книг которые они не вернули\\
	
</details>