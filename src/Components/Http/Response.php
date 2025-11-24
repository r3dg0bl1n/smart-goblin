<?php

namespace SmartGoblin\Components\Http;

enum DataType: string {
    case JSON = "application/json";
    case HTML = "text/html";
    case TEXT = "text";
}

final class Response {
    #----------------------------------------------------------------------
    #\ VARIABLES

    private string $status;
        public function getStatus(): string { return $this->status; }
    private int $code;
        public function getCode(): int { return $this->code; }
    private string $message = "";
        public function getMessage(): string { return $this->message; }
    private array $data = [];
        public function getData(): array { return $this->data; }
    
    #/ VARIABLES
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ INIT

    public static function new(bool $success, int $code): Response {
        return new Response($success, $code);
    }
    
    private function __construct(bool $success, int $code) {
        $this->status = $success ? "OK" : "ERROR";
        $this->code = $code;
    }

    #/ INIT
    #----------------------------------------------------------------------
    
    #----------------------------------------------------------------------
    #\ PRIVATE FUNCTIONS



    #/ PRIVATE FUNCTIONS
    #----------------------------------------------------------------------

    #----------------------------------------------------------------------
    #\ METHODS

    public function setBody(string $message = "", array $data = []): void {
        $this->message = $message;
        $this->data = $data;
    }

    #/ METHODS
    #----------------------------------------------------------------------
}

?>