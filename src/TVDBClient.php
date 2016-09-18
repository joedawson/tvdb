<?php

namespace Dawson\TVDB;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\RequestInterface;

class TVDBClient
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->token = null;

		$this->username = config('tvdb.username');
		$this->userkey 	= config('tvdb.userkey');
		$this->apikey	= config('tvdb.apikey');

		$this->stack = new HandlerStack();
		$this->stack->setHandler(new CurlHandler());
		$this->stack->push($this->handleAuthorizationHeader());

		$this->client = new Client([
			'handler'  => $this->stack,
			'base_uri' => 'https://api.thetvdb.com',
			'headers'  => [
				'Accept' => 'application/json',
				'Content-Type' => 'application/json',
			]
		]);
	}

	/**
	 * Obtain a Token
	 * 
	 * @return response
	 */
	public function login()
	{
		try {
			$response = $this->client->post('login', ['json' => [
				'apikey'   => $this->apikey,
				'username' => $this->username,
				'userkey'  => $this->userkey
			]])->getBody();

			$this->token = json_decode($response->getContents())->token;

			return $this;
		} catch(ClientException $e) {
			throw new TVDBException($e);
		}
	}

	/**	
	 * Handle Authorization Header
	 */
	private function handleAuthorizationHeader()
	{
		return function (callable $handler)
		{
	        return function (RequestInterface $request, array $options) use ($handler)
	        {
	        	if($this->token) {
	        		$request = $request->withHeader('Authorization', 'Bearer ' . $this->token);
	        	}

	            return $handler($request, $options);
	        };
	    };
	}
}