<?php

namespace Unit\Innovation;

use Unit\BaseTest;
use Innovation\GameState;

class GameStateTest extends BaseTest
{
    protected function setUp(): void
    {
        $this->game = $this->getMockBuilder(\stdClass::class)
            ->addMethods([
                'setGameStateValue',
                'getGameStateValue'
            ])
            ->getMock();
        $this->state = new GameState($this->game);
    }

    public function testGet()
    {
        $this->game->expects($this->once())->method('getGameStateValue')->with('foo')->willReturn('bar');

        $this->assertEquals('bar', $this->state->get('foo'));
    }

    public function testSet()
    {
        $this->game->method('setGameStateValue')->with('test', 1);
        $this->game->method('getGameStateValue')->with('test')->willReturn(1);

        $this->state->set('test', 1);
        $this->assertEquals(1, $this->state->get('test'));
    }
}
