<?php

require_once 'Zend/Http/Client.php';

class SimpleHttpClient
{
	static $_client;
	public $host;
	public $accept;

	public function __construct($host, $accept = 'json')
	{
		$this->host = $host;
		$this->accept = $accept;
	}

	public function request($method, $path, $params = null)
	{
		$method = strtoupper($method);

		$client = self::_client()
			->resetParameters()
			->setHeaders('Accept', "application/{$this->accept}")
			->setUri($this->host . $path);

		switch ($method) {
			case 'GET':
				$client->setParameterGet($params);
				break;
			case 'POST':
			case 'PUT':
				$client->setParameterPost($params);
				break;
		}

		$response = $client->request($method);
		$body = $response->getBody();

		switch ($this->accept) {
			case 'json':
				return json_decode($body);
			default:
				return $body;
		}
	}

	protected static function _client()
	{
		if (self::$_client != null) return self::$_client;

		$client = new Zend_Http_Client();
		$client->setConfig(array(
			'keepalive' => true,
			'timeout' => 30
		));
		self::$_client = $client;
		return self::$_client;
	}
}