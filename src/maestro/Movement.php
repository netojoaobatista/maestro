<?php
namespace maestro;

/**
 * Each movement is a simple step that needs to be performed in the current
 * music.
 *
 * @author João Batista Neto
 */
class Movement extends CountableAggregate
{
    /* (non-PHPdoc)
     * @see CountableAggregate::accept()
    */
    protected function accept($instance)
    {
        return $instance instanceof Executable;
    }

    /**
     * Adds something that will be executed in this Movement.
     *
     * @param Executable $executable
     */
    public function addExecutable(Executable $executable)
    {
        return $this->add($executable);
    }
}