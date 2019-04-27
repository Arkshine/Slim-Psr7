<?php
/**
 * Slim Framework (https://slimframework.com)
 *
 * @link      https://github.com/slimphp/Slim-Psr7
 * @copyright Copyright (c) 2011-2018 Josh Lockhart
 * @license   https://github.com/slimphp/Slim-Psr7/blob/master/LICENSE (MIT License)
 */
namespace Slim\Tests\Psr7;

use PHPUnit\Framework\TestCase;
use Slim\Psr7\NonBufferedBody;

class NonBufferedBodyTest extends TestCase
{
    public function testTheStreamContract()
    {
        $body = new NonBufferedBody();
        self::assertSame('', (string) $body, 'Casting to string returns no data, since the class does not store any');
        self::assertNull($body->detach(), 'Returns null since there is no such underlying stream');
        self::assertNull($body->getSize(), 'Current size is undefined');
        self::assertSame(0, $body->tell(), 'Pointer is considered to be at position 0 to conform');
        self::assertTrue($body->eof(), 'Always considered to be at EOF');
        self::assertFalse($body->isSeekable(), 'Cannot seek');
        self::assertTrue($body->isWritable(), 'Body is writable');
        self::assertFalse($body->isReadable(), 'Body is not readable');
        self::assertSame('', $body->read(10), 'Data cannot be retrieved once written');
        self::assertSame('', $body->getContents(), 'Data cannot be retrieved once written');
        self::assertNull($body->getMetadata(), 'Metadata mechanism is not implemented');
    }
}
