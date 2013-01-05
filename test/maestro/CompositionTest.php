<?php
namespace maestro;

/**
 * Composition test case.
 */
class CompositionTest extends \PHPUnit_Framework_TestCase
{
    public function testSetMusic()
    {
        $composition = new Composition();
        $music = $this->getMock('maestro\Music');

        $composition->setMusic('PS5-Cm', $music);

        $this->assertSame($music, $composition->getMusic('PS5-Cm'));
    }

    public function testGetUndefinedMusic()
    {
        $composition = new Composition();

        $this->assertNull($composition->getMusic('PS5-Cm'));
    }
}