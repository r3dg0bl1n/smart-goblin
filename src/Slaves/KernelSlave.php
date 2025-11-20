<?php

namespace SmartGoblin\Slaves;

use PHPUnit\Runner\FileDoesNotExistException;
use SmartGoblin\Exceptions\BadImplementationException;
use SmartGoblin\Internal\Factory\SlaveFactory;
use SmartGoblin\Internal\Core\Kernel;
use SmartGoblin\Components\Core\Config;

use SmartGoblin\Components\Http\DataType;
use SmartGoblin\Components\Http\Response;

final class KernelSlave extends SlaveFactory {
    private Kernel $kernel;
    private bool $readyToWork = false;

    protected function __construct() {
        $this->kernel = new Kernel();
    }

    public function order(Config $config): void {
        $this->kernel->open($config);
        $this->readyToWork = true;
    }

    public function work(): void {
        $response = null;
        
        if ($this->readyToWork) {
            
            try {
                
                if(!$response) $this->kernel->processApi($response);
                if(!$response) $this->kernel->processView($response);

            } catch(BadImplementationException | FileDoesNotExistException $e) {
                $response = Response::new(false, 500);
                $response->setBody($e->getMessage());
            }

        } else {
            $response = Response::new(false,500);
            $response->setBody("Kernel Slave does not know what is its purpose yet! Make sure to execute order method first.");
        }
        
        $this->kernel->close($response);
        exit(0);
    }
}