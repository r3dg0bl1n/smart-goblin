<?php

namespace SmartGoblin\Worker;

use SmartGoblin\Internal\Slave\HeaderSlave;
use SmartGoblin\Internal\Stash\HeaderStash;

class HeaderWorker {
    #----------------------------------------------------------------------
    #\ VARIABLES

    private static bool $working = false;
    private static HeaderStash $stash;
        public static function __sendToSlave(): void { HeaderSlave::deliver(self::$stash); }

    #/ VARIABLES
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ INIT

    public static function call(): void {
        if(!self::$working) {
            self::$working = true;
            self::$stash = new HeaderStash();
        }
    }

    #/ INIT
    #----------------------------------------------------------------------
    
    #----------------------------------------------------------------------
    #\ PRIVATE FUNCTIONS



    #/ PRIVATE FUNCTIONS
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ METHODS

    public static function writeHeader(string $key, string $value): void {
        if(self::$working) {
            self::$stash->addHeader($key, $value);
        }
    }

    public static function removeHeader(string $key): void {
        if(self::$working) {
            self::$stash->addHeaderToRemove($key);
        }
    }

    #/ METHODS
    #----------------------------------------------------------------------
}