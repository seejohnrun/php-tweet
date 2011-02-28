<?php

class TwitterUser {

    /*
     * Get a list of recent statuses from a given user
     */
    function get_user_timeline() {
        return TwitterStatus::get_user_timeline_by_user_id($this->id);
    }

    /*
     * Return a list of friends for this user
     */
    function get_friends() {
        return TwitterUser::get_friends_by_user_id($this->id);
    }

    /*
     * Get a list of friends by screen name.
     * Returns an array of TwitterUser objects
     */
    static function get_friends_by_screen_name($screen_name) {
        $data = Twitter::make_request('get', 'statuses/friends', array('screen_name' => $screen_name));
        if ($data === false) return array();
        return array_map(function($d) { return TwitterUser::from_hash($d); }, json_decode($data));
    }

    /*
     * Get a list of friends by screen name.
     * Returns an array of TwitterUser objects
     */
    static function get_friends_by_user_id($user_id) {
        $data = Twitter::make_request('get', 'statuses/friends', array('user_id' => $user_id));
        if ($data === false) return array();
        return array_map(function($d) { return TwitterUser::from_hash($d); }, json_decode($data));
    }

    /*
     * Get a TwitterUser by their screen name.
     * Returns null if there is no such user.
     */
    static function get_by_screen_name($screen_name) {
        $data = Twitter::make_request('get', 'users/show', array('screen_name' => $screen_name));
        if ($data === false) return null;
        return TwitterUser::from_hash(json_decode($data));
    }

    /*
     * Get a TwitterUser by their user id.
     * Returns null if there is no such user.
     */
    static function get_by_user_id($user_id) {
        $data = Twitter::make_request('get', 'users/show', array('user_id' => $user_id));
        if ($data === false) return null;
        return TwitterUser::from_hash(json_decode($data));
    }

    /*
     * Instantiate a TwitterUser object and populate it with the data
     * from a hash
     */
    public static function from_hash($data) {
        $user = new self();
        foreach ($data as $key => $value) $user->$key = $value;
        return $user;
    }

}
