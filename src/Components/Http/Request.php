<?php

namespace SmartGoblin\Components\Http;

final class Request {
    private string $internalID;
    private array $data;
    private string $complexPath;
    private array $originInfo = [];

    public function __construct(string $uri, string $method, string $dataStream, string $remoteAddress) {
        $this->internalID = bin2hex(random_bytes(8));

        $this->data = json_decode($dataStream, true) ?? [];

        $requestPath = parse_url($uri ?? "/", PHP_URL_PATH) ?: "/";
        $requestPath = ($requestPath !== "/") ? rtrim($requestPath, "/"): "/";
        $this->complexPath = $requestPath . "#" . $method;

        $this->originInfo["IP"] = $remoteAddress;
    }

    public function getInternalID(): string { return $this->internalID; }
    public function getDataItem(string $key): string|int|bool|null {
        if(isset($this->data[$key])) {
            return trim(strip_tags($this->data[$key]));
        }

        return null;
    }
    public function getComplexPath(): string { return $this->complexPath; }
    public function isApi(): bool {
        return str_starts_with($this->complexPath,"/api/");
    }
    public function getOriginInfo(): array { return $this->originInfo; }
}

?>