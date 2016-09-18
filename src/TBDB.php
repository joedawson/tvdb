<?php

namespace Dawson\TVDB;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\RequestInterface;

class TVDB
{
	/**
	 * Token for API Requests
	 * 
	 * @var string
	 */
	protected $token;

	/**
	 * Constructor
	 */
	public function __construct()
	{
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
	 * Search TBDB for Series
	 * 
	 * @param  string $name
	 * @return json
	 */
	public function search($name)
	{
		$this->login();

		try {
			return json_decode($this->client->get('search/series?name=' . $name)->getBody());
		} catch(ClientException $e) {
			throw new TVDBException($e);
		}
	}

	/**	
	 * Lookup a Series
	 * 
	 * @param  integer $id
	 * @return json
	 */
	public function lookup($id)
	{
		$this->login();

		try {
			return json_decode($this->client->get('series/' . $id)->getBody());
		} catch(ClientException $e) {
			throw new TVDBException($e);
		}
	}

	/**
	 * Obtain a Token
	 * 
	 * @return response
	 */
	private function login()
	{
		try {
			$response = $this->client->post('login', ['json' => [
				'apikey'   => $this->apikey,
				'username' => $this->username,
				'userkey'  => $this->userkey
			]])->getBody();

			$this->token = json_decode($response->getContents())->token;
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