<?php
namespace maestro;

class MusicTest extends CountableAggregateTest
{
    public function testAddMovement()
    {
        $music = new Music();
        $movement = $this->getMock('maestro\Movement');

        $music->addMovement($movement);

        $this->assertEquals(1, $music->count());
        $this->assertSame($movement, $music->getIterator()->current());
    }

    public function testGetIteratorOfMovement()
    {
        $music = new Music();
        $movement1 = $this->getMock('maestro\Movement');
        $movement2 = $this->getMock('maestro\Movement');

        $music->addMovement($movement1);
        $this->assertEquals(1, $music->count());

        $music->addMovement($movement2);
        $this->assertEquals(2, $music->count());

        $iterator = $music->getIterator();

        $this->assertTrue($iterator->valid());
        $this->assertSame($movement1, $iterator->current());
        $iterator->next();

        $this->assertTrue($iterator->valid());
        $this->assertSame($movement2, $iterator->current());
        $iterator->next();

        $this->assertFalse($iterator->valid());
    }
}