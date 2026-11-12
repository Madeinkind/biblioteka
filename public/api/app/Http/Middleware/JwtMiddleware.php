<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;

class JwtMiddleware
{
	/**
	 * Run the request filter.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $scopeRequired = null)
	{
		$token = $request->bearerToken();
		
		if(!$token)
		{
			// Unauthorized response if token not there
			return response()->json([
				'error' => 'Token not provided.',
			], 401);
		}
		
		try
		{
			$data = JWT::decode($token, new Key(env('JWT_PUBLIC_KEY'), 'RS256'));
			$data = json_decode(json_encode($data), true);
			//throw new Exception('Token is corrupted.');
			$decoded = [
				'session' => isset($data['s']) ? $data['s'] : '',
				'expired' => isset($data['e']) ? $data['e'] : 0,
				'created' => isset($data['c']) ? $data['c'] : 0,
			];
			if($decoded['expired'] < time())
			{
				throw new ExpiredException();
			}
		}
		catch(ExpiredException $e)
		{
			return response()->json([
				'error' => 'Provided token is expired.',
			], 400);
		}
		catch(Exception $e)
		{
			return response()->json([
				'error' => 'An error while decoding token.',
				'descr' => $e,
			], 400);
		}
		
		$request->jwt_data = $decoded;
		
		return $next($request);
	}
}
