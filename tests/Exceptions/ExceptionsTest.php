<?php

namespace SmartGoblin\Tests\Exceptions;

use PHPUnit\Framework\TestCase;
use SmartGoblin\Exceptions\BadImplementationException;
use SmartGoblin\Exceptions\EndpointFileDoesNotExist;
use SmartGoblin\Exceptions\NotAuthorizedException;

class ExceptionsTest extends TestCase
{
    public function testBadImplementationExceptionCanBeThrownAndCaught(): void
    {
        $this->expectException(BadImplementationException::class);
        $this->expectExceptionMessage("Test exception message");

        throw new BadImplementationException("Test exception message");
    }

    public function testBadImplementationExceptionExtendsException(): void
    {
        $exception = new BadImplementationException("Test");
        $this->assertInstanceOf(\Exception::class, $exception);
    }

    public function testEndpointFileDoesNotExistCanBeThrownAndCaught(): void
    {
        $this->expectException(EndpointFileDoesNotExist::class);
        $this->expectExceptionMessage("File not found");

        throw new EndpointFileDoesNotExist("File not found");
    }

    public function testEndpointFileDoesNotExistExtendsException(): void
    {
        $exception = new EndpointFileDoesNotExist("Test");
        $this->assertInstanceOf(\Exception::class, $exception);
    }

    public function testNotAuthorizedExceptionCanBeThrownAndCaught(): void
    {
        $this->expectException(NotAuthorizedException::class);
        $this->expectExceptionMessage("Unauthorized access");

        throw new NotAuthorizedException("Unauthorized access");
    }

    public function testNotAuthorizedExceptionExtendsException(): void
    {
        $exception = new NotAuthorizedException("Test");
        $this->assertInstanceOf(\Exception::class, $exception);
    }
}
