<?php

namespace Tests\IkeLutra\Swarmed;

use IkeLutra\Swarmed\Swarmed;

use PHPUnit\Framework\TestCase;
use Dotenv\Loader;

class SwarmedTest extends TestCase
{
    private $loader;

    public function setUp()
    {
        $this->loader = new Loader(null);
    }

    public function testSingleLineSecret()
    {
        $swarmed = new Swarmed();
        $swarmed->load();
        $this->assertEquals(trim(file_get_contents(__DIR__ . '/secret1.txt')), getenv('SINGLE_LINE_SECRET'));
    }

    public function testMultiLineSecret()
    {
        $swarmed = new Swarmed();
        $swarmed->load();
        $this->assertEquals(trim(file_get_contents(__DIR__ . '/secret2.txt')), getenv('MULTI_LINE_SECRET'));
    }

    public function testOverload()
    {
        putenv('SINGLE_LINE_SECRET=FooBar');
        $swarmed = new Swarmed();
        $swarmed->overload();
        $this->assertEquals(trim(file_get_contents(__DIR__ . '/secret1.txt')), getenv('SINGLE_LINE_SECRET'));
    }

    public function testImmutable()
    {
        putenv('SINGLE_LINE_SECRET=FooBar');
        $swarmed = new Swarmed();
        $swarmed->load();
        $this->assertEquals('FooBar', getenv('SINGLE_LINE_SECRET'));
    }

    public function tearDown()
    {
        $this->loader->clearEnvironmentVariable('SINGLE_LINE_SECRET');
        $this->loader->clearEnvironmentVariable('MULTI_LINE_SECRET');
    }
}
