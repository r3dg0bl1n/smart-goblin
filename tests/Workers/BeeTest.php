<?php

namespace SmartGoblin\Tests\Workers;

use PHPUnit\Framework\TestCase;
use SmartGoblin\Workers\Bee;

class BeeTest extends TestCase
{
    private array $originalEnv;

    protected function setUp(): void
    {
        parent::setUp();
        // Store original environment variables
        $this->originalEnv = $_ENV;
    }

    protected function tearDown(): void
    {
        // Restore original environment variables
        $_ENV = $this->originalEnv;
        parent::tearDown();
    }

    public function testEnvReturnsEnvironmentVariableValue(): void
    {
        $_ENV['TEST_VAR'] = 'test_value';

        $result = Bee::env('TEST_VAR');

        $this->assertEquals('test_value', $result);
    }

    public function testEnvReturnsDefaultWhenVariableDoesNotExist(): void
    {
        unset($_ENV['NON_EXISTENT_VAR']);

        $result = Bee::env('NON_EXISTENT_VAR', 'default_value');

        $this->assertEquals('default_value', $result);
    }

    public function testEnvReturnsEmptyStringWhenVariableDoesNotExistAndNoDefault(): void
    {
        unset($_ENV['NON_EXISTENT_VAR']);

        $result = Bee::env('NON_EXISTENT_VAR');

        $this->assertEquals('', $result);
    }

    public function testIsDevReturnsTrueWhenStateIsDev(): void
    {
        $_ENV['STATE'] = 'dev';

        $result = Bee::isDev();

        $this->assertTrue($result);
    }

    public function testIsDevReturnsFalseWhenStateIsNotDev(): void
    {
        $_ENV['STATE'] = 'prod';

        $result = Bee::isDev();

        $this->assertFalse($result);
    }

    public function testIsDevReturnsFalseWhenStateIsNotSet(): void
    {
        unset($_ENV['STATE']);

        $result = Bee::isDev();

        $this->assertFalse($result);
    }

    /**
     * @dataProvider normalizePathProvider
     */
    public function testNormalizePathRemovesLeadingAndTrailingSlashes(string $input, string $expected): void
    {
        $result = Bee::normalizePath($input);

        $this->assertEquals($expected, $result);
    }

    public static function normalizePathProvider(): array
    {
        return [
            // Basic normalization
            'leading slash' => ['/path/to/file', 'path/to/file'],
            'trailing slash' => ['path/to/file/', 'path/to/file'],
            'both slashes' => ['/path/to/file/', 'path/to/file'],
            'no slashes' => ['path/to/file', 'path/to/file'],
            'multiple leading slashes' => ['///path/to/file', 'path/to/file'],
            'multiple trailing slashes' => ['path/to/file///', 'path/to/file'],
            'multiple consecutive slashes' => ['path//to///file', 'path/to/file'],

            // Backslash handling
            'backslashes' => ['\\path\\to\\file\\', 'path/to/file'],
            'mixed slashes' => ['/path\\to/file\\', 'path/to/file'],
            'leading backslash' => ['\\path/to/file', 'path/to/file'],
            'trailing backslash' => ['path/to/file\\', 'path/to/file'],

            // Security: Path traversal prevention
            'parent directory traversal' => ['path/../to/file', 'path/to/file'],
            'multiple parent traversal' => ['path/../../to/file', 'path/to/file'],
            'parent at start' => ['../path/to/file', 'path/to/file'],
            'parent at end' => ['path/to/file/..', 'path/to/file'],
            'current directory' => ['path/./to/./file', 'path/to/file'],
            'mixed traversal' => ['path/../to/./file', 'path/to/file'],
            'complex traversal' => ['/path/../.././to/../file', 'path/to/file'],

            // Security: Null byte injection prevention
            'null byte in path' => ["path\0/to/file", 'path/to/file'],
            'null byte at end' => ["path/to/file\0", 'path/to/file'],

            // Edge cases
            'empty string' => ['', ''],
            'single slash' => ['/', ''],
            'single backslash' => ['\\', ''],
            'only dots' => ['...', '...'],
            'dots in filename' => ['path/to/file.txt', 'path/to/file.txt'],
        ];
    }
}
