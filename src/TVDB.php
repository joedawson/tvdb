<?php

namespace Dawson\TVDB;

use Dawson\TVDB\Resources;

class TVDB
{
	use Helpers;

	/**
	 * Series Resource
	 * 
	 * @param  integer $id
	 * @return \Dawson\TVDB\Resoures\Series
	 */
	public function series($id)
	{
		return new Resources\Series($id);
	}

	/**
	 * Search TBDB for Series
	 * 
	 * @param  string $name
	 * @return json
	 */
	public function search($name)
	{
		try {
			return json_decode($this->client()->login()->client->get('search/series?name=' . $name)->getBody());
		} catch(ClientException $e) {
			throw new TVDBException($e);
		}
	}
}