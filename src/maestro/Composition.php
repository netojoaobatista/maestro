<?php
namespace maestro;

use maestro\log\Logger;

/**
 * Composition is a full set of installable, updatable or uninstallable software.
 *
 * @author João Batista Neto
 */
class Composition
{
    /**
     * Each Music instance is a single set of installable, updatable or
     * uninstallable part of software that can be managed individually.
     *
     * @var \maestro\Music[]
     */
    private $music = array();

    /**
     * Gets the music to be played.
     *
     * @param string $name
     * @return void|\maestro\maestro\Music
     */
    public function getMusic($name)
    {
        if (!isset($this->music[$name])) {
            Logger::getLogger(__CLASS__)->notice(
                'Trying to get an undefined music "' . $name . '".');

            return;
        }

        return $this->music[$name];
    }

    /**
     * Sets a pair of name => Music to this Composition.
     *
     * @param string $name
     * @param Music $music
     */
    public function setMusic($name, Music $music)
    {
        if (isset($this->music[$name])) {
            Logger::getLogger(__CLASS__)->info(
                'Redefining the previously defined music name "' . $name . '".');
        }

        $this->music[$name] = $music;
    }
}