<?php

namespace SmartGoblin\Internal\Slave;

/*
class AuthorizationWorker {
    public static function sync(AuthorizationStash $stash): void {
        ini_set("session.use_strict_mode", 1);
        ini_set("session.gc_maxlifetime", $stash->getLifetime());
        session_name($stash->getSessionName());
        session_set_cookie_params([
            "lifetime" => $stash->getLifetime(),
            "path" => "/",
            "domain" => $stash->getDomain(),
            "secure" => true,
            "httponly" => true,
            "samesite" => "Lax"
        ]);

        session_start();
    }

    public static function isAuthenticated(AuthorizationStash $stash): bool {
        if (session_status() === PHP_SESSION_ACTIVE && session_name() === $stash->getSessionName()) {
            return isset($_SESSION["user_auth"]) && isset($_SESSION["user_id"]) && isset($_SESSION["user_custom"]);
        }

        return false;
    }

    public static function craftAuthComponent(AuthorizationStash $stash): Auth {
        if (self::isAuthenticated($stash)) {
            return new Auth($_SESSION["user_id"], $_SESSION["user_custom"], $stash);
        }

        return new Auth(-1, [], $stash);       
    }
}
    */