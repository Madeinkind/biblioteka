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

```json
{
  "list": [
    {
      "id": 1,
      "fio": "test student",
      "group": "vtipob-42",
      "iin": "4294967295"
    },
    {
      "id": 2,
      "fio": "test student 2",
      "group": "vtipob-42",
      "iin": "4294967294"
    }
  ],
  "count": 2
}
```

</details>

<details><summary><code>GET</code> <code><b>/api/books/{id}</b></code> <code>(Книги по id)</code></summary>

Принимает

	\\КНИГА ПО АЙДИ\\
	
Возвращает

	{
	"id": 3,
	"name": "dsadsa",
	"count": 1,
	"publishing": ""
	}

</details>

<details><summary><code>POST</code> <code><b>/api/books/{id}</b></code> <code>(Книги по id)</code></summary>

Принимает

	$name = 'namebook ivana';
	$count = 1;

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

	\\ВЫДАЧА КНИГИ\\

</details>

<details><summary><code>POST</code> <code><b>/api/books-issued</b></code> <code>(POST параметр выдача Книги)</code></summary>

Принимает

	$date_end = '15 января 2026';

Возвращает

	'success' => $success, \\ВЫДАЧА КНИГИ С ДАТОЙ\\\\

</details>

<details><summary><code>DELETE</code> <code><b>/api/books-issued</b></code> <code>(Удаление выданной книги)</code></summary>

Возвращает

	'success' => $success, \\УДАЛЕНИЕ КНИГИ\\

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

\\ПОИСК ПОЛЬЗОВАТЕЛЯ ПО АЙДИ\\
	
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
	
Возвращает

	'list' => $list, \\выдача список читателей\\
	'count' => $count, \\кол-во выданных книг\\

</details>

<details><summary><code>POST</code> <code><b>/api/readers</b></code> <code>(Читатели)</code></summary>

Принимает

	$fio = 'Ivan Ivanov Ivanovih'
	$group = 'POb-42';
	$iin = '123456789012';
		
Возвращает

	'id' => $id, \\айди\\
	'success' => (bool)$id, \\выдача информации\\

</details>

<details><summary><code>GET</code> <code><b>/api/readers/{id}</b></code> <code>(Читатель по id)</code></summary>

\\ ПОИСК ЧИТАТЕЛЯ ПО АЙДИ \\

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
	
Возвращает

	'list' => $list, \\выдаёт список читателей должников\\
	'count' => $count, \\кол-во книг которые они не вернули\\
	
</details>

<details><summary><code>GET</code> <code><b>/api/readers-debtors</b></code> <code>(Читатели должники)</code></summary>
	
Возвращает

	'list' => $list, \\выдаёт список читателей должников\\
	'count' => $count, \\кол-во книг которые они не вернули\\
	
</details>