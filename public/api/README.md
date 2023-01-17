# API
<details><summary>AuthController</summary>
<details><summary><code>GET</code> <code><b>/api/auth/checkauth</b></code> <code>(Проверка)</code></summary>

Возвращает
```json
{
	"auth" : true,
	"token" : "xsfsgrddgrge454etre6ytgrfy45",
	"session" : "35435trdgd5ed4trt4g",
	"expired" : 86400,
	"timeout" : 86400,
	"user_data" : [
	  "id" : 1,
	  "login" : "user", //имя 
	  "sname" : "ivanov", // фамилия 
	  "fname" : "ivan", //имя 
	  "lname" : "ivanich", //отчество 
	  "gender" : 1,
	  "email" : "user@example.com",
	  "tel" : "87011234567",
	  "about" : "i am proger",
	  "iin" : "123456789012",
	  "avatar" : "img.png",
	],
}
```
	
</details>

<details><summary><code>POST</code> <code><b>/api/auth/login</b></code> <code>(Логин, авторизация)</code></summary>
	
Принимает
```json
{
	"username" : "login", //имя
	"password" : "qwerty12345", //пароль
}
```
	
Возвращает
```json
{	
	"token" : "xsfsgrddgrge454etre6ytgrfy45",
	"session" : "35435trdgd5ed4trt4g",
	"expired" : "86400",
	"timeout" : "86400",
	"user_data" :  [
	  "id" : "1",
	  "login" : "user", //имя 
	  "sname" : "ivanov", // фамилия
	  "fname" : "ivan", //имя 
	  "lname" : "ivanich", //отчество
	  "gender" : 1,
	  "email" : "user@example.com",
	  "tel" : "87011234567",
	  "about" : "i am proger",
	  "iin" : "123456789012",
	  "avatar" : "img.png", \\Аватарка 
	],
}
```


</details>

<details><summary><code>GET</code> <code><b>/api/auth/logout</b></code> <code>(Деавторизация)</code></summary>

Возвращает
```json
{
	"success" : "true", \\Выход с аккаунта, перебрасывает на страницу входа
}
```
</details>
</details>

<details><summary>BooksController</summary>

<details><summary><code>GET</code> <code><b>/api/books</b></code> <code>(Книги)</code></summary>

Возвращает
```json
{
  "list": [
    {
      "id": 3, //айди
      "name": "dsadsa", //имя
      "count": 1, //кол-во
      "publishing": "" //издательство
    },
    {
      "id": 8, //айди
      "name": "dsadsa", //имя
      "count": 1, //кол-во
      "publishing": "" //издательство
	  "about": "" //автор
	  "inventory_number": "" //инвентарь номер
	  "year_publishing": "" //год издательства
	  "img": "" //картинка (ссылка)
    }
  ],
  "count": 2
}
```
</details>

<details><summary><code>POST</code> <code><b>/api/books</b></code> <code>(Книги)</code></summary>

Принимает

```json
{
  "id": "21312312", //айди записи
  "reader_id": "2121312312", //айди читателя
  "book_id": "21312321", //айди книги
  "date_start": "1 января 2025", //дата выдачи
  "date_end_plan": "10 января 2026", //дата возвращения
  "date_end_fact": "15 января 2026", //дата возвращения по факту
}
```

Возвращает

```json
{
  "list": [
    {
      "id": 1, //айди
      "fio": "test student", //фио
      "group": "vtipob-42", //группа
      "iin": "4294967295" //иин
    },
    {
      "id": 2, //айди
      "fio": "test student 2", //фио
      "group": "vtipob-42", //группа
      "iin": "4294967294" //иин
    }
  ],
  "count": 2 //кол-во
}
```

</details>

<details><summary><code>GET</code> <code><b>/api/books/{id}</b></code> <code>(Книги по id)</code></summary>

Принимает
```json
	//api/books/3 \\КНИГА ПО АЙДИ (3 айди	- пример)
```
Возвращает
```json
{
   "id": 3,
   "name": "dsadsa",
   "count": 1,
   "publishing": ""
}
```
</details>

<details><summary><code>POST</code> <code><b>/api/books/{id}</b></code> <code>(Книги по id)</code></summary>

Принимает
```json
{
	"name" : '', //название книги
	"count" : 1, //кол-во
	"publishing" : '', //издательство
	"about" : '', //о книге
	"inventory_number": '', //инвентарь номер
	"year_publishing": '', //год издательства
	"img" : '', //год издательства
	"author" : '', //автор
	
}
```
Возвращает
```json
{
  "id": 3,
  "name": "dsadsa",
  "count": 1,
  "publishing": ""
}
```
</details>

<details><summary><code>DELETE</code> <code><b>/books/{id}</b></code> <code>(Книги по id)</code></summary>

Возвращает
```json
{
	"success": "true", // УДАЛЕНИЕ КНИГИ ИЗ БАЗЫ
}
```
</details>

<details><summary><code>GET</code> <code><b>/api/books-issued</b></code> <code>(Выдача книг)</code></summary>

Возвращает
```json
{
  "list": [
    {
      "id": 3,
      "reader_id": 2,
      "book_id": 3,
      "date_start": "2022-12-22 05:34:56",
      "date_end_plan": "2022-12-22 05:34:56",
      "date_end_fact": "0000-00-00 00:00:00",
      "book_name": "dsadsa",
      "book_publishing": "",
      "reader_fio": "test student 2",
      "reader_group": "vtipob-42",
      "reader_iin": "4294967294"
    }
  ],
  "count": 1
}
```
</details>

<details><summary><code>POST</code> <code><b>/api/books-issued</b></code> <code>(POST параметр Выдача Книги)</code></summary>

Принимает
```json
{
	"book_id" : "32432432",
	"reader_id" : "423432432",
	"date_start" : "1 января 2025",
	"date_end" : "15 января 2026",
}
```
Возвращает
```json
{
	"id" : "1",
	"success" : "true",
}
```
</details>

<details><summary><code>GET</code> <code><b>/api/books-issued</b></code> <code>(Выдача Книги)</code></summary>

Принимает
```json
	\\ВЫДАЧА КНИГИ\\
```
</details>

<details><summary><code>POST</code> <code><b>/api/books-issued</b></code> <code>(POST параметр выдача Книги)</code></summary>

Принимает
```json
{
	"date_end": "2022-12-22", //ДАТА СДАЧИ КНИГИ
}
```
Возвращает
```json
{
  "list": [
    {
      "id": 3,
      "reader_id": 2,
      "book_id": 3,
      "date_start": "2022-12-22 05:34:56",
      "date_end_plan": "2022-12-22 05:34:56",
      "date_end_fact": "0000-00-00 00:00:00",
      "book_name": "dsadsa",
      "book_publishing": "",
      "reader_fio": "test student 2",
      "reader_group": "vtipob-42",
      "reader_iin": "4294967294"
    }
  ],
  "count": 1
}
```
</details>

<details><summary><code>DELETE</code> <code><b>/api/books-issued</b></code> <code>(Удаление выданной книги)</code></summary>

Возвращает
```json
{	
	"success": "success", \\УДАЛЕНИЕ ВЫДАННОЙ КНИГИ ИЗ БАЗЫ
}
```
</details>
</details>


<details><summary>ReadersController</summary>
<details><summary><code>GET</code> <code><b>/api/readers</b></code> <code>(Читатели)</code></summary>
	
Возвращает
```json
{
	"list" : "list", \\СПИСОК
	"count" : "2", \\кол-во
}
{
  "list": [
    {
      "id": 1,
      "fio": "\u0413\u0443\u0440\u044c\u044f\u043d\u043e\u0432 \u0418\u043b\u044c\u044f",
      "group": "vtipob-42",
      "iin": "4294967295"
    },
    {
      "id": 2,
      "fio": "\u041f\u0430\u043b\u0430\u0433\u0443\u0442\u0430 \u0414\u0430\u043d\u0438\u043b",
      "group": "vtipob-42",
      "iin": "4294967294"
    }
  ],
  "count": 2
}
```
</details>

<details><summary><code>POST</code> <code><b>/api/readers</b></code> <code>(Читатели)</code></summary>

Принимает
```json
{
	"fio" : "Ivan Ivanov Ivanovih",
	"group" : "POb-42",
	"iin" : "123456789012",
}
```		
Возвращает
```json
{
	"id" : 1, \\айди
	"success" : "true", \\выдача информации
}
```
</details>

<details><summary><code>GET</code> <code><b>/api/readers/{id}</b></code> <code>(Читатель по id)</code></summary>

 ПОИСК ЧИТАТЕЛЯ ПО АЙДИ

Возвращает
```json
{
  "id": 1,
  "fio": "test student",
  "group": "vtipob-42",
  "iin": "4294967295"
}
```
</details>

<details><summary><code>POST</code> <code><b>/api/readers/{id}</b></code> <code>(POST параметр Читатель по id)</code></summary>

Принимает
```json
{
	"fio" : "ivanov ivan ivanich",
	"group" : "POb-42",
	"iin" : "123456789012",
}
```	
Возвращает
```json
{
  "id": 7,
  "fio": "ivanov ivan ivanich",
  "group": "POb-42",
  "iin": "12345678901"
}
```	
</details>

<details><summary><code>DELETE</code> <code><b>/api/readers/{id}</b></code> <code>(Удаление Читателя по id)</code></summary>

Возвращает
```json
{
	"success" : "true", //УДАЛЕНИЕ ЧИТАТЕЛЯ ПО ID 
}
```	
</details>

<details><summary><code>GET</code> <code><b>/api/readers-debtors</b></code> <code>(Читатели должники)</code></summary>
	
Возвращает
```json
{
	"list" : "list", \\список\\
	"count" : "count", \\кол-во\\
}
{
  "list": [
    {
      "id": 3,
      "reader_id": 2,
      "reader_fio": "\u041f\u0430\u043b\u0430\u0433\u0443\u0442\u0430 \u0414\u0430\u043d\u0438\u043b",
      "reader_group": "vtipob-42",
      "reader_iin": "4294967294"
    }
  ],
  "count": 1
}
```	
</details>

<details><summary><code>GET</code> <code><b>/api/readers-debtors</b></code> <code>(Читатели должники)</code></summary>
	
Возвращает
```json
{
	"list" : "list", \\выдаёт список читателей должников
	"count" : "count", \\кол-во книг которые они не вернули
}
{
  "list": [
    {
      "id": 3,
      "reader_id": 2,
      "reader_fio": "\u041f\u0430\u043b\u0430\u0433\u0443\u0442\u0430 \u0414\u0430\u043d\u0438\u043b",
      "reader_group": "vtipob-42",
      "reader_iin": "4294967294"
    }
  ],
  "count": 1
}
```	
</details>