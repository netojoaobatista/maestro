<?php
namespace maestro\log;

/**
 * Logger test case.
 */
class LoggerTest extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Logger::setLoggerClass(Logger::getDefaultLoggerClass());

        parent::tearDown();
    }

    public function testGetLogger()
    {
        $logger = Logger::getLogger(__CLASS__);

        $this->assertInstanceOf('Psr\Log\LoggerInterface', $logger);
    }

    public function testSetLoggerClass()
    {
        $mock = $this->getMock('Psr\Log\LoggerInterface');
        $name = get_class($mock);

        Logger::setLoggerClass($name);

        $logger = Logger::getLogger(__CLASS__);

        $this->assertInstanceOf($name, $logger);
    }

    public function testSetInvalidLoggerClass()
    {
        $defaultClass = Logger::getDefaultLoggerClass();

        $this->assertFalse(Logger::setLoggerClass('InexistentLoggerClass'));
        $this->assertEquals($defaultClass, Logger::getLoggerClass());

        $this->assertFalse(Logger::setLoggerClass('\stdClass'));
        $this->assertEquals($defaultClass, Logger::getLoggerClass());
    }
}