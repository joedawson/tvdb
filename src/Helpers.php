<?php

namespace Dawson\TVDB;

trait Helpers
{
    /** 
     * Client
     * 
     * @return TVDBClient
     */
    function client()
    {
        return new TVDBClient;
    }
}