<?php

namespace SmartGoblin\Internal\Stash;

final class AuthorizationStash {
    public static function pack(): AuthorizationStash {
        return new AuthorizationStash();
    }

    protected function  __construct() {
        
    }
}