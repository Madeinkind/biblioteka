<?php

namespace App\Classes;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
	public $user_id;
	
	// данные сессии
	public $session;
	public $expired;
	public $created;
	public $signature;
	
	// сравнение токенов
	public function equal($jwt_token)
	{
		if($jwt_token == null) return false;
		if($jwt_token->user_id != $this->user_id) return false;
		if($jwt_token->session != $this->session) return false;
		if($jwt_token->expired != $this->expired) return false;
		if($jwt_token->created != $this->created) return false;
		return true;
	}
	
	// шифрование токена
	public function encode($token_private_key)
	{
		$data = array(
			'uid' => $this->user_id,
			's' => $this->session,
			'e' => $this->expired,
			'c' => time(),
		);
		
		$signature = JWT::encode($data, $token_private_key, 'RS256');
		
		$this->signature = $signature;
		return $this->signature;
	}
	
	// дешифрование токена
	public function decode($signature, $token_public_key)
	{
		if($signature == '') return false;
		
		try
		{
			$data = JWT::decode($signature, new Key($token_public_key, 'RS256'));
			$data = json_decode(json_encode($data), true);
			
			$this->user_id = isset($data['uid']) ? $data['uid'] : '';
			$this->session = isset($data['s']) ? $data['s'] : '';
			$this->expired = isset($data['e']) ? $data['e'] : '';
			$this->created = isset($data['c']) ? $data['c'] : 0;
			$this->signature = $signature;
		}
		catch(Exception $e)
		{
			return false;
		}
		
		return true;
	}
	
	// создание токена
	public static function create($token_public_key)
	{
		$signature = isset($_COOKIE[env('JWT_COOKIE')]) ? $_COOKIE[env('JWT_COOKIE')] : '';
		if($signature == '') return null;
		
		$jwt = new JWTToken();
		if(!$jwt->decode($signature, $token_public_key)) return null;
		
		return $jwt;
	}
	
	// парсер токена
	public static function parse($signature, $token_public_key)
	{
		$jwt = new JWTToken();
		if(!$jwt->decode($signature, $token_public_key)) return null;
		
		return $jwt;
	}
}
