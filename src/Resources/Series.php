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
     * @return mixed
     */
    public function get()
    {
        try {
            return json_decode($this->client()->login()->client->get('series/' . $this->id)->getBody());
        } catch (ClientException $e) {
            throw new TVDBException($e);
        }
    }

    /**
     * Series Actors
     *
     * @return mixed
     */
    public function actors()
    {
        try {
            return json_decode($this->client()->login()->client->get('series/' . $this->id . '/actors')->getBody());
        } catch (ClientException $e) {
            throw new TVDBException($e);
        }
    }

    /**
     * Series Episodes
     *
     * @return mixed
     */
    public function episodes()
    {
        try {
            return json_decode($this->client()->login()->client->get('series/' . $this->id . '/episodes')->getBody());
        } catch (ClientException $e) {
            throw new TVDBException($e);
        }
    }

    /**
     * Series Images
     *
     * @return mixed
     */
    public function images()
    {
        try {
            return json_decode($this->client()->login()->client->get('series/' . $this->id . '/images/query')->getBody());
        } catch (ClientException $e) {
            throw new TVDBException($e);
        }
    }
    /**
     * Series Wallpapers
     *
     * @return mixed
     */
    public function wallpapers()
    {
        try {
            return json_decode($this->client()->login()->client->get('series/' . $this->id . '/images/query?keyType=fanart')->getBody());
        } catch (ClientException $e) {
            throw new TVDBException($e);
        }
    }

    /**
     * Series Posters
     *
     * @return mixed
     */

    public function posters()
    {
        try {
            return json_decode($this->client()->login()->client->get('series/' . $this->id . '/images/query?keyType=poster')->getBody());
        } catch (ClientException $e) {
            throw new TVDBException($e);
        }
    }
}
