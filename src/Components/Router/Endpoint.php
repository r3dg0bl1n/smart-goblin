<?php

namespace SmartGoblin\Components\Router;

use SmartGoblin\Helpers\Bee;

final class Endpoint {
    private bool $restricted;
    private string $complexPath;
    private string $file;

    public static function new(bool $restricted, string $method, string $path, string $fileName): Endpoint {
        return new Endpoint($restricted, $method, $path, $fileName);
    }

    protected function __construct(bool $restricted, string $method, string $path, string $fileName) {
        $this->restricted = $restricted;
        $this->complexPath = "/".Bee::normalizePath($path)."#".$method;
        $this->file = Bee::normalizePath($fileName, true);
    }

    public function getRestricted(): bool { return $this->restricted; }
    public function getComplexPath(): string { return $this->complexPath; }
    public function getFile(): string { return $this->file; }
}