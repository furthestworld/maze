<?php
/**
 *+------------------------------------------------------------------------------------------------+
 *| A PHP Configuration File Manager                                                               |
 *+------------------------------------------------------------------------------------------------+
 *| @license   Apache License 2.0                                                                  |
 *| @copyright Copyright (c) 2017 Qingshan Luo                                                     |
 *+------------------------------------------------------------------------------------------------+
 *| @author    Qingshan Luo <shanshan.lqs@gmail.com>                                               |
 *+------------------------------------------------------------------------------------------------+
 */
namespace MazeTest;

use Maze\Maze;
use PHPUnit\Framework\TestCase;

/**
 * Maze configuration file manager unit test.
 */
class MazeTest extends TestCase
{

    public function testMaze()
    {
        $maze = new Maze(dirname(__DIR__));
        $bag  = $maze->load('test');

        $this->assertEquals($bag->all(), require (dirname(__DIR__) . '/test.conf.php'));
        $this->assertEquals($bag->get('testKey2.key'), 'value');
    }
}
