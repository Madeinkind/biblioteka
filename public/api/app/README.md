# API
<details><summary>#  Заголовок первого уровня</summary>
<details><summary><code>GET</code> <code><b>/</b></code> <code>(auth/checkauth)</code></summary>

get('/auth/checkauth', 'AuthController@checkauth')

Получает

	$jwt_token = JWTToken::create(env('JWT_PUBLIC_KEY'));
	$arr = DB::table('sessions')
	$user = DB::table('users')
	$user_roles = User::getRoles($user->id);
	$expired = time() + env('JWT_COOKIE_TIMEOUT');
	$jwt_token->expired = $expired;
	$jwt_string = $jwt_token->encode(env('JWT_PRIVATE_KEY'));
	$domain = get_domain();

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
	'theme' => $user->theme,
	'lang_code' => $user->lang_code,
	'user_roles' => $user_roles,
	
</details>

<details><summary><code>POST</code> <code><b>/</b></code> <code>(auth/login)</code></summary>
	
Получает
	
	$data = $request->input();
	$username = isset($data['username']) ? $data['username'] : '';
	$password = isset($data['password']) ? $data['password'] : '';
	$session = '';
	$jwt_token = JWTToken::create(env('JWT_PUBLIC_KEY'));
	$user = DB::table('users')
	$jwt_token = new JWTToken();
	$jwt_token->user_id = $user->id;
	$jwt_token->session = $session;
	$jwt_token->expired = $expired;
	$jwt_string = $jwt_token->encode(env('JWT_PRIVATE_KEY'));
	$domain = get_domain();
	
Возвращает
	
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
	'theme' => $user->theme,
	'lang_code' => $user->lang_code,

</details>

<details><summary><code>GET</code> <code><b>/</b></code> <code>(auth/logout)</code></summary>

Получает

	jwt_token = JWTToken::create(env('JWT_PUBLIC_KEY'));
	$domain = get_domain();
	
Возвращает
	
	return response()->json([
	'success' => true,
	], 200);

</details>
</details>

<details><summary><code>GET</code> <code><b>/</b></code> <code>(auth/logout)</code></summary>