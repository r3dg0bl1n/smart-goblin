<?php

namespace SmartGoblin\Internal\Stash;

/*
final class AuthorizationStash {
    private string $sessionName;
    private int $lifetime;
    private string $domain;

    public static function pack(string $sessionName, int $expiryDays, string $domain): AuthorizationStash {
        return new AuthorizationStash($sessionName, $expiryDays, $domain);
    }

    private function  __construct(string $sessionName, int $expiryDays, string $domain) {
        $this->sessionName = $sessionName;
        $this->lifetime = $expiryDays * 24 * 60 * 60;
        $this->domain = $domain;
    }

    public function getSessionName(): string { return $this->sessionName; }
    public function getLifetime(): int { return $this->lifetime; }
    public function getDomain(): string { return $this->domain; }
}*/