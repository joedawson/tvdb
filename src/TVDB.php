<?php

namespace Dawson\TVDB;

use Dawson\TVDB\Resources;

class TVDB
{
    use Helpers;

    /**
     * Series Resource
     * 
     * @param  integer $id TVDB Series ID.
     * @return \Dawson\TVDB\Resoures\Series
     */
    public function series($id)
    {
        return new Resources\Series($id);
    }

    /**
     * Search TBDB for Series
     * 
     * @param  string $name Name of TV Series to search for.
     * @return mixed
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