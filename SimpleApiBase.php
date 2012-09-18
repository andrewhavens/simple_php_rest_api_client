<?php

require_once 'SimpleHttpClient.php';

class SimpleApiBase
{
	public static $base_uri;
	public static $app_id;
	public static $app_secret;
	public static $access_token;

	public static function __callStatic($method, $arguments)
    {
    	if (count($arguments) == 1) {
    		$arguments[] = null; //adds an empty $params arg
    	}

		list($path, $params) = $arguments;
		return self::request($method, $path, $params);
    }
	
	public static function request($method, $path, $params = null)
	{
		$client = new SimpleHttpClient(self::$base_uri);
		return $client->request($method, $path, $params);
	}
}
