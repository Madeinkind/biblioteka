<details><summary>ReadersController</summary>
<details><summary><code>GET</code> <code><b>/api/readers</b></code> <code>(Читатели)</code></summary>
	
Возвращает
```json
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
</details>