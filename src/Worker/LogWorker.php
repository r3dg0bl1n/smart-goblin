<?php

namespace SmartGoblin\Worker;

use SmartGoblin\Internal\Slave\LogSlave;
use SmartGoblin\Internal\Stash\LogStash;

class LogWorker {
    #----------------------------------------------------------------------
    #\ VARIABLES

    private static bool $working = false;
    private static LogStash $stash;
        public static function __delegateDumpToSlave(): void { LogSlave::dump(self::$stash); }

    #/ VARIABLES
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ INIT

    public static function call(): void {
        if(!self::$working) {
            self::$working = true;
            self::$stash = new LogStash();
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

    public static function log(string $text): void {
        if(self::$working) {
            self::$stash->addLog(date("Y-m-d H:i:s"), $text);
        }
    }

    #/ METHODS
    #----------------------------------------------------------------------
}