<?php
namespace maestro;

use \ArrayIterator;
use \Countable;
use \IteratorAggregate;
use \InvalidArgumentException;
use \UnexpectedValueException;

abstract class CountableAggregate implements Countable, IteratorAggregate
{
    /**
     * @var array
     */
    private $storage = array();

    /**
     * Check if the supplied instance is acceptable to this data structure.
     *
     * @param mixed $instance
     * @return boolean
     */
    protected abstract function accept($instance);

    public function add($instance)
    {
        if (!is_object($instance)) {
            throw new UnexpectedValueException(__METHOD__ . ' expects an object.');
        }

        if (!$this->accept($instance)) {
            throw new InvalidArgumentException('Invalid object type.');
        }

        $this->storage[] = $instance;
    }

    /* (non-PHPdoc)
     * @see Countable::count()
    */
    public function count()
    {
        return count($this->storage);
    }

    /* (non-PHPdoc)
     * @see IteratorAggregate::getIterator()
    */
    public function getIterator()
    {
        return new ArrayIterator($this->storage);
    }
}