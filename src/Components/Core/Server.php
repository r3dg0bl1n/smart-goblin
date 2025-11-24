<?php

namespace SmartGoblin\Components\Core;

use SmartGoblin\Exceptions\BadImplementationException;
use SmartGoblin\Exceptions\EndpointFileDoesNotExist;

use SmartGoblin\Internal\Core\Kernel;

use SmartGoblin\Components\Core\Config;
use SmartGoblin\Components\Http\Response;

final class Server {
    #----------------------------------------------------------------------
    #\ VARIABLES

    private Kernel $kernel;
    private bool $ready = false;

    #/ VARIABLES
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ INIT

    public static function new(): Server {
        return new Server();
    }

    private function __construct() {
        $this->kernel = new Kernel();
    }

    public function configure(Config $config): void {
        $this->kernel->setConfig($config);
        $this->ready = true;
    }

    #/ INIT
    #----------------------------------------------------------------------
    
    #----------------------------------------------------------------------
    #\ PRIVATE FUNCTIONS



    #/ PRIVATE FUNCTIONS
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ METHODS

    public function run(): void {
        $response = null;
        
        if ($this->ready) {
            $this->kernel->open();

            try {
                
                $response = $this->kernel->isApiRequest() ? $this->kernel->processApi() : $this->kernel->processView();

            } catch(BadImplementationException | EndpointFileDoesNotExist $e) {
                $response = Response::new(false, 500);
                $response->setBody($e->getMessage());
            }
            
            $this->kernel->close($response);
        } else {
            http_response_code(500);
        }
        
        exit(0);
    }

    #/ METHODS
    #----------------------------------------------------------------------
}