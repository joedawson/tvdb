<?php

namespace Dawson\TVDB;

trait Helpers
{
    /** 
     * Client
     * 
     * @return \Dawson\TVDB\TVDBClient
     */
    function client()
    {
        return new TVDBClient;
    }
}