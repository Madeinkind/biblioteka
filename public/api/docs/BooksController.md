<details><summary>BooksController</summary>

<details><summary><code>GET</code> <code><b>/api/books</b></code> <code>(Книги)</code></summary>

Возвращает
```json
{
  "list": [
    {
      "id": 3, //айди
      "name": "dsadsa", //имя
      "speciality": "", //кол-во
      "publishing": "" //издательство
    },
    {
      "id": 8, //айди
      "name": "dsadsa", //имя
      "speciality": "", //кол-во
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
   "speciality": "",
   "publishing": ""
}
```
</details>

<details><summary><code>POST</code> <code><b>/api/books/{id}</b></code> <code>(Книги по id)</code></summary>

Принимает
```json
{
	"name" : '', //название книги
	"speciality" : '', //кол-во
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