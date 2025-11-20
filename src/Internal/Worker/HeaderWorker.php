<?php

namespace SmartGoblin\Internal\Worker;

use SmartGoblin\Internal\Stash\HeaderStash;

class HeaderWorker {
    public static function dump(HeaderStash $stash): void {
        foreach($stash->getHeaderList() as $key => $value) header($key.": ".$value);
        foreach($stash->getHeaderRemoveList() as $value) header_remove($value);
    }

    public static function addAndDump(HeaderStash $stash, string $key, string $value): void {
        $stash->addHeader($key, $value);
        header($key.": ".$value);
    }
}