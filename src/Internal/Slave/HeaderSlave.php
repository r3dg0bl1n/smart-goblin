<?php

namespace SmartGoblin\Internal\Slave;

use SmartGoblin\Worker\HeaderWorker;
use SmartGoblin\Internal\Stash\HeaderStash;

final class HeaderSlave {
    #----------------------------------------------------------------------
    #\ VARIABLES

    

    #/ VARIABLES
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ INIT

    public static function zap(): void {
        HeaderWorker::call();
    }

    #/ INIT
    #----------------------------------------------------------------------
    
    #----------------------------------------------------------------------
    #\ PRIVATE FUNCTIONS



    #/ PRIVATE FUNCTIONS
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ METHODS

    // TODO: Enable wildcard for allowedHosts
    public static function writeSecurityHeaders(array $allowedHosts, string $https, string $origin): void {
        HeaderWorker::removeHeader("X-Powered-By");

        HeaderWorker::writeHeader("X-Content-Type-Options", "nosniff");
        HeaderWorker::writeHeader("Referrer-Policy", "strict-origin-when-cross-origin");
        HeaderWorker::writeHeader("Cross-Origin-Resource-Policy", "same-origin");
        HeaderWorker::writeHeader("Content-Security-Policy", "frame-ancestors 'none';");
        HeaderWorker::writeHeader("X-Frame-Options", "DENY");
        HeaderWorker::writeHeader("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
        HeaderWorker::writeHeader("Access-Control-Allow-Headers", "Content-Type");

        if (!empty($https) && $https !== 'off') {
            HeaderWorker::writeHeader("Strict-Transport-Security", "max-age=31536000; includeSubDomains; preload");
        }
        
        $origin = $origin ?? ""; // TODO: Do more research about HTTP_ORIGIN
        if (in_array($origin, $allowedHosts, true)) {
            HeaderWorker::writeHeader("Access-Control-Allow-Origin", "https://$origin");
            HeaderWorker::writeHeader("Access-Control-Allow-Credentials", "true");
            HeaderWorker::writeHeader("Vary", "Origin");
        }
    }

    public static function writeUtilityHeaders(bool $isApi): void {
        // TODO: Add complexity for better cache control
        if($isApi) HeaderWorker::writeHeader("Cache-Control", "private, no-store, must-revalidate");
        else HeaderWorker::writeHeader("Cache-Control", "private, max-age=0, no-cache, must-revalidate");
    }

    public static function deliver(HeaderStash &$stash): void {
        foreach($stash->getHeaderList() as $key => $value) header($key.": ".$value);
        foreach($stash->getRemoveHeaderList() as $value) header_remove($value);

        $stash->empty();
    }

    #/ METHODS
    #----------------------------------------------------------------------
}