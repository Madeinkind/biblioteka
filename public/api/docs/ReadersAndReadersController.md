<details><summary>ReadersAndReadersController</summary>
<details><summary><code>GET</code> <code><b>/books-readers</b></code> <code>(get параметр выдача книг)</code></summary>
Принимает
```json
  "list": [
    {
	"reader_id": , \\ айди читателя
	"book_id": , \\ айди книги
	"date_start": , \\ дата выдачи
	"date_end_plan": , \\ дата сдачи по плану
    }
  ],
  "count": 1
}
```
Возвращает
```json
  "list": [
    {
      "id": 1,
      "reader_id": 2,
      "book_id": 12,
      "date_start": "2000-12-12 00:00:00",
      "date_end_plan": "2000-12-13 00:00:00",
      "date_end_fact": "2000-12-14 00:00:00",
      "book_name": "dsadasdsa",
      "book_publishing": "dsadsadasdas",
      "reader_fio": "\u041f\u0430\u043b\u0430\u0433\u0443\u0442\u0430 \u0414\u0430\u043d\u0438\u043b",
      "reader_group": "vtipob-42",
      "reader_iin": "4294967294"
    }
  ],
  "count": 1
}
```
</details>	
<details><summary><code>POST</code> <code><b>/books-readers</b></code> <code>(POST параметр выдача книг)</code></summary>
Принимает
```json
[
	"reader_id": , \\ айди читателя
	"book_id": , \\ айди книги
	"date_start": , \\ дата выдачи
	"date_end_plan": , \\ дата сдачи по плану
]
```
Возвращает
```json

	"success" : "true",

```
</details>
<details><summary><code>POST</code> <code><b>/books-readers/{id}</b></code> <code>(POST параметр выдача книг)</code></summary>
Принимает
```json

"date_end_fact": , \\ дата сдачи по факту

```
Возвращает
```json
 \\Обновление в базе, возврат книги
"success" : "true",

```
</details>
</details>