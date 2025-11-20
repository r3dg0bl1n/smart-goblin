<?php

namespace SmartGoblin\Internal\Worker;

use SmartGoblin\Internal\Stash\HeaderStash;
use SmartGoblin\Internal\Stash\MetaStash;

class MetaWorker {
    public static function dump(MetaStash $stash, HeaderStash $headerStash): void {
        HeaderWorker::addAndDump($headerStash, "X-Meta-Request-Time", microtime(true) - $stash->getStartRequestTime());
    }
}