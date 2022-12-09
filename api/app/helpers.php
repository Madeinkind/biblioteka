<?php

if(!function_exists('rand_str'))
{
	/*
	Генерация рандомных символов
	$params				[array]		// массив параметров, содержащий в себе:
		"length"		[string]	// длина генерируемого пароля. (по умолчанию: 12)
		"upperchars"	[boolean]	// использовать в пароле буквы верхнего регистра (по умолчанию: false)
		"lowerchars"	[boolean]	// использовать в пароле буквы нижнего регистра (по умолчанию: false)
		"numeric"		[boolean]	// использовать в пароле цифры (по умолчанию: false)
		"symbols"		[boolean]	// использовать в пароле спецсимволы (по умолчанию: false)
		"mode"			[string]	// вместо параметров upperchars, lowerchars, numeric, symbols можно использовать этот быстрый параметр
									// Значения:
									// n - numeric
									// l - lowerchars
									// u - upperchars
									// s - special symbols
									// можно использовать комбинации этих 4х параметров, например nl, nul, su, nlus и т. д.
									// у параметров upperchars, lowerchars, numeric, symbols приоритет выше, чем у mode
									// если указать numeric = true и mode = "lu", то numbers будет включен
									// по умолчанию ''
		"exclude"		[array]		// массив символов, которые нужно проигнорировать (не использовать при генерации)
									// ex: array('a', '_', 'E', '!', '7')
	*/
	function rand_str($params = [])
	{
		$length = isset($params['length']) ? $params['length'] : 12;
		$mode = isset($params['mode']) ? $params['mode'] : '';
		
		$is_upperchars = isset($params['upperchars']) ? $params['upperchars'] : contains($mode, 'u');
		$is_lowerchars = isset($params['lowerchars']) ? $params['lowerchars'] : contains($mode, 'l');
		$is_numeric = isset($params['numeric']) ? $params['numeric'] : contains($mode, 'n');
		$is_symbols = isset($params['symbols']) ? $params['symbols'] : contains($mode, 's');
		
		$rnda = [];
		if($is_upperchars) $rnda[] = 'upperchars';
		if($is_lowerchars) $rnda[] = 'lowerchars';
		if($is_numeric) $rnda[] = 'numeric';
		if($is_symbols) $rnda[] = 'symbols';
		
		$exclude = isset($params['exclude']) ? $params['exclude'] : [];
		
		$arr = [
			'upperchars' => [
				'A', 'B', 'C', 'D', 'E', 'F', 
				'G', 'H', 'I', 'J', 'K', 'L', 
				'M', 'N', 'O', 'P', 'R', 'S', 
				'T', 'U', 'V', 'X', 'Y', 'Z'
			],
			'lowerchars' => [
				'a', 'b', 'c', 'd', 'e', 'f', 
				'g', 'h', 'i', 'j', 'k', 'l', 
				'm', 'n', 'o', 'p', 'r', 's', 
				't', 'u', 'v', 'x', 'y', 'z'
			],
			'numeric' => [
				'1', '2', '3', '4', '5', 
				'6', '7', '8', '9', '0'
			],
			'symbols' => [
				'#', '!', '@', '$', 
				'%', '^', '&', '*', 
				'_', '=', '+', '-', 
				'(', ')', '[', ']', 
				'?', '{', '}', '.', 
				',', '/', '~', '`',
				'<', '>', '"', ':',
				';', '|'
			],
		];
		if(get_value_type($exclude) == 'array' and count($exclude) > 0)
		{
			foreach($arr as $key => $data)
			{
				$newdata = [];
				foreach($data as $k => $val)
				{
					if(!in_array($val, $exclude)) $newdata[] = $val;
				}
				$arr[$key] = $newdata;
			}
		}
		$pass = '';
		if(count($rnda) > 0)
		{
			for($cnt = 0; $cnt < $length; $cnt++)
			{
				$subrnda = rand(0, count($rnda) - 1);
				$subindex = $rnda[$subrnda];
				$index = rand(0, count($arr[$subindex]) - 1);
				$pass .= $arr[$subindex][$index];
			}
		}
		return $pass;
	}
}

if(!function_exists('get_value_type'))
{
	/*
	Получение типа переменной
	$var	[mixed]		// проверяемая переменная
	*/
	function get_value_type($var = null)
	{
		$type = gettype($var);
		if(is_numeric($var))
		{
			$intval = intval($var);
			$floatval = floatval($var);
			if($intval != $floatval)
			{
				return "double";
			}
			return "integer";
		}
		return $type;
	}
}

if(!function_exists('contains'))
{
	/*
	Проверка текста на существование в другом тексте
	$haystack	[string]					// текст, в котором ищем $needle
	$needle		[string | array(string)]	// текст, который ищем в $haystack
	$or			[boolean]					// определяет, искать все совпадения или некоторые (для массивов, необязательный параметр)
											// если false, то ищет строго все совпадения из массива
											// при не нахождении хотя-бы одного несовпадения, вернет false
											// если true, то ищет хотя-бы одно совпадение из массива
											// при нахождении хотя-бы одного совпадения, вернет true
	examples:
		contains("abcdef", "ef") //возвратит true
		contains("abcdef", "ed") //возвратит false
		contains("abcdef", array("ef", "cd")) //возвратит true
		contains("abcdef", array("ef", "ed")) //возвратит false
		contains('abcdef', array('ef', 'ed'), true) //возвратит true
		contains('abcdef', array('ed', 'fd'), true) //возвратит false
	*/
	function contains($haystack = '', $needle = '', $or = false)
	{
		if(get_value_type($needle) == "array")
		{
			if($or)
			{
				foreach($needle as $keyval) if(strpos($haystack, $keyval) !== false) return true; return false;
			}
			else
			{
				foreach($needle as $keyval) if(strpos($haystack, $keyval) === false) return false; return true;
			}
		}
		else
		{
			return strpos($haystack, $needle) !== false;
		}
	}
}

if(!function_exists('get_domain'))
{
	/*
	Получение домена
	*/
	function get_domain()
	{
		$domain = '';
		$server_name = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
		if($server_name == '')
		{
			$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
		}
		$arr = array_reverse(preg_split('/\./', $server_name));
		$i = 0;
		foreach($arr as $d)
		{
			$domain = '.'.$d.$domain;
			$i++;
			if($i > 1) break;
		}
		return $domain;
	}
}

if(!function_exists('strtotimestamp'))
{
	/*
	переводит в datetimestr строку во временную зону timezone учитывая, 
	что строка находится во временной зоне datetime_timezone
	и возвращает timestamp
	*/
	function strtotimestamp($datetimestr, $timezone = null, $datetime_timezone = null)
	{
		$date_end = null;
		if($datetimestr != null)
		{
			try
			{
				if($datetime_timezone == null)
				{
					$date = new DateTime($datetimestr, new DateTimeZone('UTC'));
				}
				else
				{
					$date = new DateTime($datetimestr, new DateTimeZone($datetime_timezone));
				}
				if($timezone === null)
				{
					$date->setTimeZone(new DateTimeZone('UTC'));
				}
				else
				{
					$date->setTimeZone(new DateTimeZone($timezone));
				}
				$date_end = $date->getTimestamp();
			}
			catch(Exception $e)
			{
				//echo $e->getMessage();
				$date_end = null;
			}
		}
		return $date_end;
	}
}

if(!function_exists('isHttps'))
{
	function isHttps()
	{
		return isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' : false;
	}
}

if(!function_exists('getAvatar'))
{
	function getAvatar($user_login)
	{
		$user_login = md5($user_login);
		$avaPath = '/files/avatar/';
		$fullPath = '/files/avatar/';
		for($ii = 0; $ii < 5; $ii += 2)
		{
			$avaPath .= substr($user_login, $ii, 2).'/';
			$fullPath .= substr($user_login, $ii, 2).'/';
		}
		$avaLink = $avaPath.$user_login.'_small.jpg';
		$bigAvaLink = $avaPath.$user_login.'_big.jpg';
		$fullAvaLink = $fullPath.$user_login.'_small.jpg';
		$fullBigAvaLink = $fullPath.$user_login.'_big.jpg';
		$avaInfo = array(
			'avaPath' => $avaPath,
			'avaLink' => $avaLink,
			'big' => $bigAvaLink,
			'bigAvaLink' => $bigAvaLink,
			'fullPath' => $fullPath,
			'fullAvaLink' => $fullAvaLink,
			'fullBig' => $fullBigAvaLink,
		);
		return $avaInfo;
	}
}

if(!function_exists('getRealIP'))
{
	/*
	Получение реального IP пользователя
	*/
	function getRealIP($method = 2)
	{
		$client_ip = 'unknown';
		
		if($method == 1)
		{
			if(empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$_SERVER['HTTP_X_FORWARDED_FOR'] = $_SERVER['REMOTE_ADDR'];
			}
			if($_SERVER['HTTP_X_FORWARDED_FOR'] != '')
			{
				$client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] :
					((!empty($_ENV['REMOTE_ADDR'])) ? $_ENV['REMOTE_ADDR'] : "unknown");
				$entries = explode('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
				reset($entries);
				while(list(, $entry) = each($entries))
				{
					$entry = trim($entry);
					if(preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list))
					{
						$private_ip = array('/^0\./', '/^127\.0\.0\.1/', '/^192\.168\..*/', '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', '/^10\..*/');
						$found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
						if($client_ip != $found_ip)
						{
							$client_ip = $found_ip;
							break;
						}
					}
				}
			}
			else
			{
				$client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : (
					(!empty($_ENV['REMOTE_ADDR'])) ? $_ENV['REMOTE_ADDR'] : 'unknown'
				);
			}
		}
		elseif($method == 2)
		{
			switch(true)
			{
				case (!empty($_SERVER['HTTP_X_REAL_IP'])):
					$client_ip = $_SERVER['HTTP_X_REAL_IP'];
					break;
				case (!empty($_SERVER['HTTP_CLIENT_IP'])):
					$client_ip = $_SERVER['HTTP_CLIENT_IP'];
					break;
				case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
					$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					break;
				default:
					$client_ip = $_SERVER['REMOTE_ADDR'];
					break;
			}
		}
		
		return $client_ip;
	}
}