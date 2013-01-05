<?php
namespace maestro;

use maestro\log\Logger;

/**
 * Composition is a full set of installable, updatable or uninstallable parts
 * of software.
 *
 * @author João Batista Neto
 */
class Composition
{

    /**
     * Each Music instance is an installable, updatable or uninstallable part of
     * software that can be managed individually.
     *
     * @var maestro\Music []
     */
    private $music = array();

    public function getMusic($name)
    {
        if (!isset($this->music[$name])) {
            Logger::getLogger(__CLASS__)->notice(
                'Trying to get an undefined music "' . $name . '".');

            return;
        }

        return $this->music[$name];
    }

    public function setMusic($name, Music $music)
    {
        if (isset($this->music[$name])) {
            Logger::getLogger(__CLASS__)->info(
                'Redefining the previously defined music name "' . $name . '".');
        }

        $this->music[$name] = $music;
    }
}