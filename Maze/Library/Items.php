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
namespace Maze\Library;

/**
 * Maze configuration item manager.
 */
class Items
{
    /**
     * All loaded configuration items.
     *
     * @var  array
     */
    protected $items = [];

    /**
     * Initialize this items instanse.
     *
     * @param   array  $items  All configuration items.
     * @return  void
     */
    public function __construct(array $items)
    {

        $this->items = $items;
    }

    /**
     * Check whether the configuration item exists.
     *
     * @param   string  $key  The configuration item name.
     * @return  boolean
     */
    public function exists($key)
    {

        return array_key_exists($key, $this->items);
    }

    /**
     * Get a configuration item value.
     *
     * @param   string   $key      The configuration item name.
     * @param   mixed    $default  The default value.
     * @return  mixed
     */
    public function get($key, $default = null)
    {
        if ($this->exists($key)) {
            $item = $this->items[$key];
        } else {
            $keys = explode('.', $key);
            if (count($keys) > 1) {
                $item = $this->items;
                while (!empty($keys)) {
                    $k = array_shift($keys);
                    if (is_array($item) && array_key_exists($k, $item)) {
                        $item = $item[$k];
                    } else {
                        $item = $default;
                        break;
                    }
                }
            } else {
                $item = $default;
            }
        }

        return $item;
    }

    /**
     * Get all configuration item values.
     *
     * @return  array
     */
    public function all()
    {

        return $this->items;
    }

    /**
     * Add or update a configuration item.
     *
     * @param   string   $key     The configuration item name.
     * @param   mixed    $value   The configuration item value.
     * @param   boolean  $cover   Overlay operation.
     * @return  boolean
     */
    public function set($key, $value, $cover = false)
    {
        if ($cover || !$this->exists($key)) {
            $this->items[$key] = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Merge all configuration items from another items instance.
     *
     * @param   self     $config  Another items instance.
     * @param   boolean  $cover   Overlay operation.
     * @return  self
     */
    public function merge(self $items, $cover = true)
    {
        foreach ($items->all() as $key => $value) {
            $this->set($key, $value, $cover);
        }

        return $this;
    }

    /**
     * Forget a configuration item.
     *
     * @param   string  $key  The configuration item name.
     * @return  self
     */
    public function forget($key)
    {
        if ($this->exists($key)) {
            unset($this->items[$key]);
        }

        return $this;
    }
}
