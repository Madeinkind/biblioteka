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
		
		$expired = time() + env('JWT_COOKIE_TIMEOUT');
		
		DB::table('sessions')
			->where('ssid', '=', $session)
			->update([
				'expired' => @gmdate('Y-m-d H:i:s', $expired),
			]);
		
		// создаем новый JWT токен
		$jwt_token = new JWTToken();
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
			'auth' => true,
			'token' => $jwt_string,
			'session' => $session,
			'expired' => $expired,
			'timeout' => env('JWT_COOKIE_TIMEOUT'),
		], 200);
	}
	
	public function login(Request $request)
	{
		$data = $request->input();
		$login = isset($data['login']) ? $data['login'] : '';
		$password = isset($data['password']) ? $data['password'] : '';
		
		if($login == '')
		{
			return response()->json([
				'error' => 'Login not provided.',
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
		
		$admin_login = env('ADMIN_LOGIN');
		$admin_password = env('ADMIN_PASSWORD');
		
		if($login != $admin_login
		or $password != $admin_password)
		{
			return response()->json([
				'error' => 'Пара логин/пароль не совпадает',
			], 400);
		}
		
		if($session == '')
		{
			$session = rand_str(['length' => 128, 'mode' => 'nul']).time();
		}
		
		$expired = time() + env('JWT_COOKIE_TIMEOUT');
		
		DB::table('sessions')
			->updateOrInsert(
				['ssid' => $session],
				['expired' => @gmdate('Y-m-d H:i:s', $expired)]
			);
		
		$jwt_token = new JWTToken();
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
