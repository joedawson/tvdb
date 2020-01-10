<?php

namespace Dawson\TVDB\Resources;

use Dawson\TVDB\TVDB;

class Movies extends TVDB
{
    /**
     * Episode ID
     *
     * @var integer
     */
    protected $id;

    /**
     * Constructor
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Get the Movie
     *
     * @return json
     */
    public function get()
    {
        try {
            return json_decode(
                $this->client()->login()->client->get('movies/' . $this->id
            )->getBody());
        } catch (ClientException $e) {
            throw new TVDBException($e);
        }
    }
}
