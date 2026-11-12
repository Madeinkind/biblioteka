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