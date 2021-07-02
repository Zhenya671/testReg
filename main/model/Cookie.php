<?php

class Cookie {

    const WEEK = 60 * 60 * 24 * 7;

    public static function create(Users $users, $numberUser) {

        $cookieKey = $users::generateSalt(20);
        $user = $users->addCookieKey($numberUser, $cookieKey);

        setcookie("login", (string)$user->user[$numberUser]->login, time() + self::WEEK, '/');
        setcookie("cookieKey", $cookieKey, time() + self::WEEK, '/');
        header("Refresh:0");

    }

    public static function destroy() {

        setcookie("login", '', time(), '/');
        setcookie("cookieKey", '', time(), '/');

    }

}