<?php
namespace maestro;

class MovementTest extends CountableAggregateTest
{
    public function testAcceptExecutable()
    {
        $executable = $this->getMock('maestro\Executable');
        $movement = $this->getMock('maestro\Movement',
                                   array('accept'));

        $movement->expects($this->at(0))
                 ->method('accept')
                 ->with($executable)
                 ->will($this->returnValue(true));

        $movement->addExecutable($executable);
    }

    public function testAddExecutable()
    {
        $movement = new Movement();
        $executable = $this->getMock('maestro\Executable');

        $movement->addExecutable($executable);

        $this->assertEquals(1, $movement->count());
        $this->assertSame($executable, $movement->getIterator()->current());
    }

    public function testGetIteratorOfExecutable()
    {
        $movement = new Movement();
        $executable1 = $this->getMock('maestro\Executable');
        $executable2 = $this->getMock('maestro\Executable');

        $movement->addExecutable($executable1);
        $this->assertEquals(1, $movement->count());

        $movement->addExecutable($executable2);
        $this->assertEquals(2, $movement->count());

        $iterator = $movement->getIterator();

        $this->assertTrue($iterator->valid());
        $this->assertSame($executable1, $iterator->current());
        $iterator->next();

        $this->assertTrue($iterator->valid());
        $this->assertSame($executable2, $iterator->current());
        $iterator->next();

        $this->assertFalse($iterator->valid());
    }
}