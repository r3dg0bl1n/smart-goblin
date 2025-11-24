<?php

namespace SmartGoblin\Internal\Slave;

use SmartGoblin\Components\Http\Request;
use SmartGoblin\Worker\LogWorker;
use SmartGoblin\Internal\Stash\LogStash;

final class LogSlave {
    #----------------------------------------------------------------------
    #\ VARIABLES

    

    #/ VARIABLES
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ INIT

    public static function zap(): void {
        LogWorker::call();
    }

    #/ INIT
    #----------------------------------------------------------------------
    
    #----------------------------------------------------------------------
    #\ PRIVATE FUNCTIONS

    private static function writeIntoFile(string $text): void {
        $dir = SITE_PATH . DIRECTORY_SEPARATOR . "logs" . DIRECTORY_SEPARATOR;
        if(!is_dir($dir)) mkdir($dir, 0755, true);

        file_put_contents($dir . date("dmY") . ".log", $text, FILE_APPEND | LOCK_EX);
    }

    #/ PRIVATE FUNCTIONS
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ METHODS

    public static function writeOpenLogs(Request $request): void {
        $type = $request->isApi() ? "API" : "VIEW";
        LogWorker::log("# OPEN {$type} REQUEST({$request->getInternalID()})");
        LogWorker::log("--- Complex Path: {$request->getComplexPath()}");
        LogWorker::log("--- Remote Address: {$request->getOriginInfo()["IP"]}");
    }

    public static function writeCloseLogs(Request $request, float $elapsedTime): void {
        LogWorker::log("--- Request time: " . $elapsedTime . "ms");
        LogWorker::log("# CLOSE REQUEST({$request->getInternalID()})");
        LogWorker::log("=======================================================");
    }

    public static function deliver(LogStash &$stash): void {
        $textBlock = "";
        foreach($stash->getLogList() as $obj) $textBlock .= "[".$obj["prefix"]."] ".$obj["value"]."\n";
        self::writeIntoFile($textBlock);

        $stash->empty();
    }

    #/ METHODS
    #----------------------------------------------------------------------
}