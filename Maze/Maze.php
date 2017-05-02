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
namespace Maze;

use Maze\Library\Items;

/**
 * Maze configuration file manager.
 *
 * The configuration file must be a PHP script file,
 * and the script file must return an array containing all the configuration items.
 *
 * If the configuration file does not exist or script file does not return an array,
 * you will get an empty instances of Maze\Library\Items.
 */
class Maze
{
    /**
     * The configuration file root directory.
     *
     * @var  string
     */
    protected $root;

    /**
     * Initialize this Maze instanse.
     *
     * @param   string  $root  The configuration file root directory.
     * @return  void
     */
    public function __construct($root)
    {

        $this->root = rtrim(str_replace('\\', '/', $root), '/');
    }

    /**
     * Load a configuration file.
     *
     * @param   string  $name  The configuration file name.
     * @return  Maze\Library\Items
     */
    public function load($name)
    {
        $path  = $this->root . '/' . $name . '.conf.php';
        $items = [];

        if (file_exists($path)) {
            $items = require $path;
            if (!is_array($items)) {
                $items = [];
            }
        }

        return new Items($items);
    }
}
