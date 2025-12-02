<?php

namespace SmartGoblin\Components\Core;

use SmartGoblin\Exceptions\BadImplementationException;
use SmartGoblin\Exceptions\EndpointFileDoesNotExist;

use SmartGoblin\Exceptions\NotAuthorizedException;
use SmartGoblin\Internal\Core\Kernel;

use SmartGoblin\Components\Core\Config;
use SmartGoblin\Components\Routing\Router;
use SmartGoblin\Components\Http\Response;

use SmartGoblin\Workers\LogWorker;
use SmartGoblin\Workers\HeaderWorker;

final class Server {
    #----------------------------------------------------------------------
    #\ VARIABLES

    private Kernel $kernel;
    private bool $ready = false;

    #/ VARIABLES
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ INIT

    /**
     * Creates a new instance of the Server class.
     *
     * @return Server
     */
    public static function new(): Server {
        return new Server();
    }

    private function __construct() {
        $this->kernel = new Kernel();
    }

    /**
     * Configures the server.
     *
     * @param Config $config The configuration to use.
     * @param Template $template The default template for all views.
     * @param Router $viewRouter The View Router to use.
     * @param Router $apiRouter The API Router to use.
     */
    public function configure(Config $config, Template $template, Router $viewRouter, Router $apiRouter): void {
        $this->kernel->setConfig($config);
        $this->kernel->setTemplate($template);
        $this->kernel->setViewRouter($viewRouter);
        $this->kernel->setApiRouter($apiRouter);
        $this->ready = true;
    }

    #/ INIT
    #----------------------------------------------------------------------
    
    #----------------------------------------------------------------------
    #\ PRIVATE FUNCTIONS

    // I don't like this...
    private function getUnauthorizedResponse(bool $domainLevel, string $msg): Response {
        $response = null;
        $redirect = $domainLevel ? $this->kernel->getConfig()->getDefaultUnauthorizedSubdomainRedirect() : $this->kernel->getConfig()->getDefaultUnauthorizedPathRedirect();
        if($this->kernel->isApiRequest()) {
            $response = Response::new(false, 401, $msg);
        } else {
            $response = Response::new(false, 301, $msg);
            HeaderWorker::addHeader("Location", $redirect);
        }

        return $response;
    }

    // Or this ._.
    private function getNotFoundResponse(): Response {
        $response = null;
        if($this->kernel->isApiRequest()) {
            $response = Response::new(false, 404, "Request not found");
        } else {
            $response = Response::new(false, 301);
            HeaderWorker::addHeader("Location", $this->kernel->getConfig()->getDefaultNotFoundPathRedirect());
        }

        return $response;
    }

    #/ PRIVATE FUNCTIONS
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ METHODS

    /**
     * Starts the server and handles incoming requests.
     *
     * If the server has not been configured, it will return a 500 status code.
     *
     * Handles BadImplementationException, EndpointFileDoesNotExist, and NotAuthorizedException.
     */
    public function run(): void {
        if ($this->ready) {
            $response = null;
            try {
                $this->kernel->open();
            } catch(NotAuthorizedException $e) {
                $response = $this->getUnauthorizedResponse(true, $e->getMessage());
                LogWorker::error("-SG- " . $e->getMessage());
            }
            

            try {
                $response = $this->kernel->process();
                if($response === null) { 
                    $response = $this->getNotFoundResponse();
                    LogWorker::warning("-SG- Request did not find matching route");
                } else {
                    LogWorker::log("-SG- Request processed successfully");
                }
                
            } catch(BadImplementationException | EndpointFileDoesNotExist $e) {
                $response = Response::new(false, 500);
                LogWorker::error("-SG- " . $e->getMessage());
            } catch(NotAuthorizedException $e) {
                $response = $this->getUnauthorizedResponse(false, $e->getMessage());
                LogWorker::error("-SG- " . $e->getMessage());
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