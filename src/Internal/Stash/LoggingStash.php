<?php

namespace SmartGoblin\Internal\Stash;

use SmartGoblin\Components\Http\Request;

final class LoggingStash {
    private array $logList = [];

    public static function pack(): LoggingStash {
        return new LoggingStash();
    }

    private function  __construct() {
        
    }

    public function addLog(string $text): void {
        $this->logList[] = [
            "time" => date("Y-m-d H:i:s"),
            "value" => $text
        ];
    }

    public function getLogList(): array { return $this->logList; }
}