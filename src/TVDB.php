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
     * Episodes Resource
     * 
     * @param  integer $id TVDB Episode ID.
     * @return \Dawson\TVDB\Resoures\Episodes
     */
    public function episode($id)
    {
        return new Resources\Episode($id);
    }

    /**
     * Movies Resource
     * 
     * @param  integer $id TVDB Movie ID.
     * @return \Dawson\TVDB\Resoures\Movies
     */
    public function movies($id)
    {
        return new Resources\Movies($id);
    }

    /**
     * Search TVDB for Series
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