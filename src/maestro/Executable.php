<?php
namespace maestro;

/**
 * Executable is anything that can be used to perform the current Movement.
 *
 * @author João Batista Neto
 */
interface Executable
{
    /**
     * Executes this thing.
     *
     * @return boolean
     */
    public function execute();
}