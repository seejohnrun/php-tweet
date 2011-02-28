<?php

define('TWITTER_BASE_URL', 'api.twitter.com');
define('TWITTER_API_VERSION', 1);

require 'lib/twitter_user.php';
require 'lib/twitter_status.php';

class Twitter {

    /*
     * Make a request with the given method and parameters to the twitter
     * service and the given $path
     */
    public static function make_request($method, $path, $params) {
        // build the param string
        $param_w = array();
        foreach ($params as $key => $value) $param_w[] = "$key=$value";
        $param_string = implode('&', $param_w);
        // make the request
        return @file_get_contents('http://'.TWITTER_BASE_URL.'/'.TWITTER_API_VERSION."/{$path}.json?{$param_string}");
    }

}
