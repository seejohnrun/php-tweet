<?php

require 'twitter.php';

class TwitterUserTest extends PHPUnit_Framework_TestCase {

    function __construct() {
        $this->ro_user = TwitterUser::get_by_screen_name('seejohnrun');
    }

    function test_get_by_screen_name_happy_path() {
        $user = TwitterUser::get_by_screen_name('seejohnrun');
        $this->assertEquals($user->screen_name, 'seejohnrun');
        $this->assertType('TwitterUser', $user);
    }

    function test_get_by_screen_name_nonexist() {
        $user = TwitterUser::get_by_screen_name('sfsq82jsqjer');
        $this->assertNull($user);
    }

    function test_get_friends_by_screen_name() {
        $users = TwitterUser::get_friends_by_screen_name('seejohnrun');
        foreach ($users as $user) $this->assertType('TwitterUser', $user);
    }

    function test_get_friends() {
        $user = TwitterUser::get_by_screen_name('seejohnrun');
        $friends = $user->get_friends();
        foreach ($friends as $friend) { $this->assertType('TwitterUser', $user); }
    }

    function test_get_user_timeline() {
        $statuses = $this->ro_user->get_user_timeline();
        foreach ($statuses as $status) { $this->assertType('TwitterStatus', $status); }
    }

}
