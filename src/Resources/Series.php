<?php

namespace Dawson\TVDB\Resources;

use Dawson\TVDB\TVDB;

class Series extends TVDB
{
	/**
	 * Series ID
	 * 
	 * @var integer
	 */
	public $id;

	/**
	 * Constructor
	 */
	public function __construct(int $id)
	{
		$this->id = $id;
	}

	/**
	 * Get the Series
	 * 
	 * @return json
	 */
	public function get()
	{
		try {
			return json_decode($this->client()->login()->client->get('series/' . $this->id)->getBody());
		} catch(ClientException $e) {
			throw new TVDBException($e);
		}
	}

	/**
	 * Series Actors
	 * 
	 * @return json
	 */
	public function actors()
	{
		try {
			return json_decode($this->client()->login()->client->get('series/' . $this->id . '/actors')->getBody());
		} catch(ClientException $e) {
			throw new TVDBException($e);
		}
	}

	/**
	 * Series Episodes
	 * 
	 * @return json
	 */
	public function episodes()
	{
		try {
			return json_decode($this->client()->login()->client->get('series/' . $this->id . '/episodes')->getBody());
		} catch(ClientException $e) {
			throw new TVDBException($e);
		}
	}

	/**
	 * Series Images
	 * 
	 * @return json
	 */
	public function images()
	{
		try {
			return json_decode($this->client()->login()->client->get('series/' . $this->id . '/images/query')->getBody());
		} catch(ClientException $e) {
			throw new TVDBException($e);
		}
	}
}
