<?php

namespace SendMagic;

use SendMagic\Exceptions\Api;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class ApiResource {

	public $baseUrl = 'https://api.sendmagic.io';
	public $secret_key;
	public $client;

	public function __construct($secret_key)
	{
		$this->secret_key = $secret_key;
		$this->client = new Client();
	}

	protected function validateParams($params = null)
	{
		if ($params && !is_array($params)) {
			$message = "You must pass an array as the first argument.";
			throw new Api($message);
		}
	}

	protected function post_request($path, array $params)
	{
		$endpoint = $this->baseUrl . $path;
		$response = $this->client->request('POST', $endpoint, [
			'json' => $params,
			'auth' => [$this->secret_key, null],
			'headers' => [
				'Accept' => 'application/json'
			],
		]);
		return $this->handleResponse($response);
	}

	protected function delete_request($path, array $params)
	{
		$endpoint = $this->baseUrl . $path;
		$response = $this->client->request('DELETE', $endpoint, [
			'json' => $params,
			'auth' => [$this->secret_key, null],
			'headers' => [
				'Accept' => 'application/json'
			],
		]);
		return $this->handleResponse($response);
	}

	private function handleResponse(Response $response)
	{
		$stream = \GuzzleHttp\Psr7\stream_for($response->getBody());
		$data = json_decode($stream);
		return $data;
	}
}
