<?php
namespace maestro\log;

use \ReflectionClass;

/**
 * Helper for creation of instances of the Psr\Log\LoggerInterface interface.
 *
 * @author João Batista Neto
 */
class Logger
{
    /**
     * Default Logger class name.
     *
     * @var string
     */
    private static $defaultLoggerClass = 'Monolog\Logger';

    /**
     * Current defined Logger class name.
     *
     * @var string
     */
    private static $loggerClass;

    /**
     * Create an instante of LoggerInterface using the defined Logger class name
     *
     * @param string $name The logging channel
     * @return Psr\Log\LoggerInterface
     * @throws \ReflectionException
     */
    private static function createDefaultLogger($name)
    {
        $reflection = new ReflectionClass(static::getLoggerClass());
        $argv = array();

        if ($reflection->getConstructor() !== null) {
            $argv[] = $name;
        }

        return $reflection->newInstanceArgs($argv);
    }

    /**
     * Gets the name of the default Logger class.
     *
     * @return string
     */
    public static function getDefaultLoggerClass()
    {
        return static::$defaultLoggerClass;
    }

    /**
     * Gets the name of the defined Logger class
     *
     * @return string
     */
    public static function getLoggerClass()
    {
        if (static::$loggerClass == null) {
            static::setLoggerClass(static::$defaultLoggerClass);
        }

        return static::$loggerClass;
    }

    /**
     * Gets an instance of LoggerInterface for the specified channel.
     *
     * @param string $name The logging channel
     * @return \Psr\Log\LoggerInterface
     */
    public static function getLogger($name)
    {
        return static::createDefaultLogger($name);
    }

    /**
     * Sets the name of the class that implements LoggerInterface.
     *
     * @param string $name
     * @return boolean
     */
    public static function setLoggerClass($name)
    {
        $success = true;

        if (!static::validadeLoggerClass($name)) {
            $name = static::$defaultLoggerClass;
            $success = false;
        }

        static::$loggerClass = $name;

        return $success;
    }

    /**
     * Checks if the specified class exists and implements the
     * PSR\Log\LoggerInterface.
     *
     * @param string $name The name of the class that will be checked.
     * @return boolean
     */
    private static function validadeLoggerClass($name)
    {
        $success = true;

        if (($c = !class_exists($name, true)) ||
            ($i = !in_array('Psr\Log\LoggerInterface', class_implements($name)))) {

            if ($c) {
                static::getLogger(__CLASS__)->error(
                        'Class "' . $name . '" does not exist.');
            } else if ($i) {
                static::getLogger(__CLASS__)->error(
                        'Class "' . $name . '" does not implements the PSR\Log\LoggerInterface.');
            }

            $success = false;
        }

        return $success;
    }
}