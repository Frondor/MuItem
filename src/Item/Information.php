<?php

/**
 * @package 	MuItem
 * @link 		https://github.com/WoLfulus/MuItem
 * @copyright 	WoLfulus
 * @license 	GNU General Public License 2, see LICENSE
 */

/**
* Item information class.
*/
class Mu_Item_Information
{
    /**
    * Stores the item type.
    *
    * @var mixed
    */
    private $type = 1;

    /**
    * Gets the item type.
    *
    * @return int
    */
    public function getType()
    {
        return $this->type;
    }

    /**
    * Sets the item type.
    *
    * @param mixed $value
    */
    public function setType($value)
    {
        $this->type = $value;
    }

    /**
    * Stores the item index.
    *
    * @var mixed
    */
    private $index = 1;

    /**
    * Gets the item index.
    *
    * @return int
    */
    public function getIndex()
    {
        return $this->index;
    }

    /**
    * Sets the item index.
    *
    * @param mixed $value
    */
    public function setIndex($value)
    {
        $this->index = $value;
    }

    /**
    * Stores the item width.
    *
    * @var mixed
    */
    private $width = 1;

    /**
    * Gets the item width.
    *
    * @return int
    */
    public function getWidth()
    {
        return $this->width;
    }

    /**
    * Sets the item width.
    *
    * @param mixed $value
    */
    public function setWidth($value)
    {
        $this->width = $value;
    }

    /**
    * Stores the item height.
    *
    * @var mixed
    */
    private $height = 1;

    /**
    * Gets the item height.
    *
    * @return int
    */
    public function getHeight()
    {
        return $this->height;
    }

    /**
    * Sets the item height.
    *
    * @param mixed $value
    */
    public function setHeight($value)
    {
        $this->height = $value;
    }

    /**
    * Stores the item name.
    *
    * @var mixed
    */
    private $name = "Unnamed";

    /**
    * Gets the item name.
    *
    * @return int
    */
    public function getName()
    {
        return $this->name;
    }

    /**
    * Sets the item name.
    *
    * @param mixed $value
    */
    public function setName($value)
    {
        $this->name = $value;
    }

    /**
    * Stores the item durability.
    *
    * @var mixed
    */
    private $durability = 1;

    /**
    * Gets the item durability.
    *
    * @return int
    */
    public function getDurability()
    {
        return $this->durability;
    }

    /**
    * Sets the item durability.
    *
    * @param mixed $value
    */
    public function setDurability($value)
    {
        $this->durability = $value;
    }

    /**
    * Constructor.
    */
    public function __construct()
    {
    }
}
