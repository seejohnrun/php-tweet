<?php

class TwitterStatus {

    /*
     * Get recent statuses by the user
     */
    static function get_user_timeline_by_screen_name($screen_name) {
        $data = Twitter::make_request('get', 'statuses/user_timeline', array('screen_name' => $screen_name));
        if ($data === false) return null;
        return array_map(function($d) { return TwitterStatus::from_hash($d); }, json_decode($data));
    }

    /*
     * Get recent statuses by the user, specified by user_id
     */
    static function get_user_timeline_by_user_id($user_id) {
        $data = Twitter::make_request('get', 'statuses/user_timeline', array('user_id' => $user_id));
        if ($data === false) return array();
        return array_map(function($d) { return TwitterStatus::from_hash($d); }, json_decode($data));
    }

    /*
     * Load a twitter status update from hash
     */
    public static function from_hash($data) {
        $obj = new self();
        foreach ($data as $k => $v) $obj->$k = $v;
        return $obj;
    }

}
