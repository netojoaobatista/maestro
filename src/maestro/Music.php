<?php
namespace maestro;

/**
 * Each Music instance is a single set of installable, updatable or
 * uninstallable part of software that can be managed individually.
 *
 * @author João Batista Neto
 */
class Music extends CountableAggregate
{
    /* (non-PHPdoc)
     * @see CountableAggregate::accept()
    */
    protected function accept($instance)
    {
        return $instance instanceof Movement;
    }

    /**
     * Add a Movement to this Music.
     *
     * @param \maestro\Movement $movement
     */
    public function addMovement(Movement $movement)
    {
        $this->add($movement);
    }
}