<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie;

use App\Classes\JWTToken;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('jwt.auth');
    }
	
	public function checkauth(Request $request)
	{
		DB::table('sessions')
			->where('expired', '<=', @gmdate('Y-m-d H:i:s', time()))
			->delete();
		
		// получаем токен
		$jwt_token = JWTToken::create(env('JWT_PUBLIC_KEY'));
		if($jwt_token)
		{
			$session = $jwt_token->session;
		}
		if($jwt_token == null)
		{
			return response()->json([
				'auth' => false,
			], 200);
		}
		
		$arr = DB::table('sessions')
			->where('ssid', '=', $session)
			->where('expired', '>', @gmdate('Y-m-d H:i:s', time()))
			->first();
		if(!$arr)
		{
			return response()->json([
				'auth' => false,
			], 200);
		}
		
		$user = DB::table('users')
			//->select('')
			->where('id', '=', $arr->user_id)
			->first();
		if(!$user)
		{
			return response()->json([
				'auth' => false,
			], 200);
		}
		
		$user_roles = User::getRoles($user->id);
		
		$expired = time() + env('JWT_COOKIE_TIMEOUT');
		
		DB::table('sessions')
			->where('ssid', '=', $session)
			->update([
				'expired' => @gmdate('Y-m-d H:i:s', $expired),
			]);
		
		// создаем новый JWT токен
		//$jwt_token = new JWTToken();
		//$jwt_token->user_id = $user->id;
		//$jwt_token->session = $session;
		$jwt_token->expired = $expired;
		$jwt_string = $jwt_token->encode(env('JWT_PRIVATE_KEY'));
		
		$domain = get_domain();
		if(isHttps())
		{
			header(
				'Set-Cookie: '.urlencode(env('JWT_COOKIE')).'='.urlencode($jwt_string).'; '.
				'Max-Age='.urlencode($expired).'; '.
				'path=/; domain='.urlencode($domain).'; SameSite=None; Secure'
			);
		}
		else
		{
			setcookie(env('JWT_COOKIE'), $jwt_string, $expired, '/', $domain);
		}
		
		return response()->json([
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
			],
			'user_roles' => $user_roles,
		], 200);
	}
	
	public function login(Request $request)
	{
		$data = $request->input();
		$username = isset($data['username']) ? $data['username'] : '';
		$password = isset($data['password']) ? $data['password'] : '';
		
		if($username == '')
		{
			return response()->json([
				'error' => 'Username not provided.',
			], 400);
		}
		
		if($password == '')
		{
			return response()->json([
				'error' => 'Password not provided.',
			], 400);
		}
		
		// получаем токен
		$session = '';
		$jwt_token = JWTToken::create(env('JWT_PUBLIC_KEY'));
		if($jwt_token)
		{
			$session = $jwt_token->session;
		}
		
		$user = DB::table('users')
			//->select('')
			->orWhere('login', '=', $username)
			->orWhere('email', '=', $username)
			->orWhere('tel', '=', $username)
			->first();
		if(!$user)
		{
			return response()->json([
				'error' => 'Пользователь не найден',
			], 400);
		}
		
		if(md5($password) != $user->password)
		{
			return response()->json([
				'error' => 'Пароль не совпадает',
			], 400);
		}
		
		$user_roles = User::getRoles($user->id);
		
		if($session == '')
		{
			$session = rand_str(['length' => 128, 'mode' => 'nul']).time();
		}
		
		$expired = time() + env('JWT_COOKIE_TIMEOUT');
		
		DB::table('sessions')
			->updateOrInsert(
				['ssid' => $session],
				[
					'user_id' => $user->id,
					'ip' => getRealIP(),
					'expired' => @gmdate('Y-m-d H:i:s', $expired)
				]
			);
		
		$jwt_token = new JWTToken();
		$jwt_token->user_id = $user->id;
		$jwt_token->session = $session;
		$jwt_token->expired = $expired;
		$jwt_string = $jwt_token->encode(env('JWT_PRIVATE_KEY'));
		
		$domain = get_domain();
		if(isHttps())
		{
			header(
				'Set-Cookie: '.urlencode(env('JWT_COOKIE')).'='.urlencode($jwt_string).'; '.
				'Max-Age='.urlencode($expired).'; '.
				'path=/; domain='.urlencode($domain).'; SameSite=None; Secure'
			);
		}
		else
		{
			setcookie(env('JWT_COOKIE'), $jwt_string, $expired, '/', $domain);
		}
		
		return response()->json([
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
			],
			'user_roles' => $user_roles,
		], 200);
	}
	
	public function logout(Request $request)
	{
		$jwt_token = JWTToken::create(env('JWT_PUBLIC_KEY'));
		if($jwt_token)
		{
			$session = $jwt_token->session;
		}
		if($session)
		{
			DB::table('sessions')
				->where('ssid', '=', $session)
				->delete();
		}
		
		$domain = get_domain();
		if(isHttps())
		{
			header(
				'Set-Cookie: '.urlencode(env('JWT_COOKIE')).'=deleted; '.
				'Max-Age=0; '.
				'path=/; domain='.urlencode($domain).'; SameSite=None; Secure'
			);
		}
		else
		{
			setcookie(env('JWT_COOKIE'), '', 0, '/', $domain); // удалить куки
		}
		
		return response()->json([
			'success' => true,
		], 200);
	}
}
