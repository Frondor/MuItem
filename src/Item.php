<?php

/**
 * @package 	MuItem
 * @link 		https://github.com/WoLfulus/MuItem
 * @copyright 	WoLfulus
 * @license 	GNU General Public License 2, see LICENSE
 */

/**
* Item class.
*/
class Mu_Item
{
    /**
    * Stores the item information.
    *
    * @var mixed
    */
    private $information = null;

    /**
    * Stores the item type (section).
    *
    * @var int
    */
    private $type = -1;

    /**
    * Sets the item type.
    *
    * @param int $value
    */
    public function setType($value)
    {
        $this->type = ($value > 15 ? 15 : ($value < 0 ? 0 : $value)); ;
    }

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
    * Stores the item index.
    *
    * @var int
    */
    private $index = -1;

    /**
    * Sets the item index.
    *
    * @param int $value
    */
    public function setIndex($value)
    {
        $this->index = ($value > 512 ? 512 : ($value < 0 ? 0 : $value)); ;
    }

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
    * Stores the item level.
    *
    * @var int
    */
    private $level = 0;

    /**
    * Sets the item level.
    *
    * @param int $value
    */
    public function setLevel($value)
    {
        $this->level = ($value > 15 ? 15 : ($value < 0 ? 0 : $value)); ;
    }

    /**
    * Gets the item level.
    *
    * @return int
    */
    public function getLevel()
    {
        return $this->level;
    }

    /**
    * Stores the item option.
    *
    * @var int
    */
    private $option = 0;

    /**
    * Sets the item option.
    *
    * @param int $value
    */
    public function setOption($value)
    {
        $this->option = ($value > 7 ? 7 : ($value < 0 ? 0 : $value)); ;
    }

    /**
    * Gets the item option.
    *
    * @return int
    */
    public function getOption()
    {
        return $this->option;
    }

    /**
    * Stores the item durability.
    *
    * @var int
    */
    private $durability = 0;

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
        $this->durability = ($value > 255 ? 255 : ($value < 0 ? 0 : $value));
    }

    /**
    * Resets the item with its default durability.
    *
    * @return void
    */
    public function repair()
    {
        $initial = $this->getInformation()->getDurability();
        if($this->level > 0 && $this->level < 5)
        {
            $initial = $initial + $this->level;
        }
        elseif($this->level >= 5 && $this->level < 10)
        {
            $initial = $initial + 4 + (($this->level - 4) * 2);
        }
        elseif($this->level >= 10 && $this->level < 12)
        {
            $initial = $initial + 14 + (($this->level - 9) * 3);
        }
        elseif($this->level >= 12)
        {
            $initial = $initial + 20 + (($this->level - 11) * 6);
        }
        $this->durability = $initial > 255 ? 255 : ($initial < 0 ? 0 : $initial);
    }

    /**
    * Stores the item skill.
    *
    * @var bool
    */
    private $skill = false;

    /**
    * Sets the item skill.
    *
    * @param int $value
    */
    public function setSkill($value)
    {
        $this->skill = (bool) $value;
    }

    /**
    * Gets the item skill.
    *
    * @return int
    */
    public function getSkill()
    {
        return $this->type;
    }

    /**
    * Stores the item luck.
    *
    * @var bool
    */
    private $luck = false;

    /**
    * Sets the item luck.
    *
    * @param int $value
    */
    public function setLuck($value)
    {
        $this->luck = (bool) $value;
    }

    /**
    * Gets the item luck.
    *
    * @return int
    */
    public function getLuck()
    {
        return $this->luck;
    }

    /**
    * Stores the item excellents.
    *
    * @var mixed
    */
    private $excellent = array(false, false, false, false, false, false);

    /**
    * Sets the item excellent.
    *
    * @param int $value
    */
    public function setExcellents($value)
    {
        $this->excellent = $value;
    }

    /**
    * Sets the item excellent.
    *
    * @param int $value
    */
    public function setExcellent($index, $value)
    {
        $this->excellent[$index] = (bool) $value;
    }

    /**
    * Gets the item excellent.
    *
    * @return int
    */
    public function getExcellents()
    {
        return $this->excellent;
    }

    /**
    * Gets the item excellent.
    *
    * @return int
    */
    public function getExcellent($index)
    {
        return $this->excellent[$index];
    }

    /**
    * Stores the item serial.
    *
    * @var int
    */
    private $serial = -1;

    /**
    * Sets the item serial.
    *
    * @param int $value
    */
    public function setSerial($value)
    {
        $this->serial = $value;
    }

    /**
    * Gets the item serial.
    *
    * @return int
    */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
    * Stores the item ancient.
    *
    * @var int
    */
    private $ancient = 0;

    /**
    * Sets the item ancient.
    *
    * @param int $value
    */
    public function setAncient($value)
    {
        $this->ancient = $value;
    }

    /**
    * Gets the item ancient.
    *
    * @return int
    */
    public function getAncient()
    {
        return $this->ancient;
    }

    /**
    * Stores the item harmony type.
    *
    * @var int
    */
    private $harmonyType = 0;

    /**
    * Sets the item harmony type.
    *
    * @param int $value
    */
    public function setHarmonyType($value)
    {
        $this->harmonyType = $value;
    }

    /**
    * Gets the item harmony type.
    *
    * @return int
    */
    public function getHarmonyType()
    {
        return $this->harmonyType;
    }

    /**
    * Stores the harmony level.
    *
    * @var int
    */
    private $harmonyLevel = 0;

    /**
    * Sets the item harmony level.
    *
    * @param int $value
    */
    public function setHarmonyLevel($value)
    {
        $this->harmonyLevel = $value;
    }

    /**
    * Gets the item harmony level.
    *
    * @return int
    */
    public function getHarmonyLevel()
    {
        return $this->harmonyLevel;
    }

    /**
    * Stores the level option.
    *
    * @var int
    */
    private $levelOption = 0;

    /**
    * Sets the item level option.
    *
    * @param int $value
    */
    public function setLevelOption($value)
    {
        $this->levelOption = $value;
    }

    /**
    * Gets the item level option.
    *
    * @return int
    */
    public function getLevelOption()
    {
        return $this->levelOption;
    }

    /**
    * Constructor.
    *
    */
    public function __construct()
    {
        $this->index = -1;
        $this->type = -1;
    }

    /**
    * Converts the current item to a string.
    *
    * @return string
    */
    public function __toString()
    {
        return $this->generate();
    }

    /**
    * Parses an item from its dump.
    *
    * @param mixed $dump Database dump.
    * @param mixed $version Database version.
    *
    * @return Mu_Item
    */
    public static function parse($dump, $version = null)
    {
        if ($version == null)
        {
            $version = Mu_Library::getVersion();
        }

        $dump = strtoupper($dump);

        /**
        * Item parser
        */
        switch ($version)
        {
            /**
            * 0.97D
            */
            case Mu_Version::V097:
                {
                    if ($dump == str_repeat("FF", 10) || strlen($dump) != 20)
                    {
                        return null;
                    }

                    $item = new Mu_Item();

                    // [FF] FF FF FFFFFFFF FF FF FF
                    $temp = hexdec(substr($dump, 0, 2));
                    $item->type = ($temp & 0xE0) >> 5;
                    $item->index = (($temp & 0x1F));

                    // FF [FF] FF FFFFFFFF FF FF FF
                    $temp = hexdec(substr($dump, 2, 2));
                    $item->skill = (($temp & 0x80) == 0x80);
                    $item->luck = (($temp & 0x04) == 0x04);
                    $item->level = (($temp & 0x78) >> 3);
                    $item->option = ($temp & 0x03);

                    // FF FF [FF] FFFFFFFF FF FF FF
                    $temp = hexdec(substr($dump, 4, 2));
                    $item->durability = $temp;

                    // FF FF FF [FFFFFFFF] FF FF FF;
                    $temp = hexdec(substr($dump, 6, 8));
                    $item->serial = $temp;

                    // FF FF FF FFFFFFFF [FF] FF FF
                    $temp = hexdec(substr($dump, 14, 2));

                    $item->type += ((($temp & 0x80) == 0x80) ? 8 : 0);
                    $item->option += ((($temp & 0x40) == 0x40) ? 4 : 0);
                    $item->excellent[0] = (($temp & 0x01) == 0x01);
                    $item->excellent[1] = (($temp & 0x02) == 0x02);
                    $item->excellent[2] = (($temp & 0x04) == 0x04);
                    $item->excellent[3] = (($temp & 0x08) == 0x08);
                    $item->excellent[4] = (($temp & 0x10) == 0x10);
                    $item->excellent[5] = (($temp & 0x20) == 0x20);

                    $item->information = Mu_Library::getDatabase()->getItem($item->getType(), $item->getIndex());

                    return $item;
                }

            /**
            * 0.99B+
            */
            case Mu_Version::V099:
                {
                    if ($dump == str_repeat("FF", 10) || strlen($dump) != 20)
                    {
                        return null;
                    }

                    $item = new Mu_Item();

                    // [FF] FF FF FFFFFFFF FF FF FF
                    $temp = hexdec(substr($dump, 0, 2));
                    $item->type = ($temp & 0xE0)  >> 5;
                    $item->index = (($temp & 0x1F));

                    // FF [FF] FF FFFFFFFF FF FF FF
                    $temp = hexdec(substr($dump, 2, 2));
                    $item->skill = (($temp & 0x80) == 0x80);
                    $item->luck = (($temp & 0x04) == 0x04);
                    $item->level = (($temp & 0x78) >> 3);
                    $item->option = ($temp & 0x03);

                    // FF FF [FF] FFFFFFFF FF FF FF
                    $temp = hexdec(substr($dump, 4, 2));
                    $item->durability = $temp;

                    // FF FF FF [FFFFFFFF] FF FF FF;
                    $temp = hexdec(substr($dump, 6, 8));
                    $item->serial = $temp;

                    // FF FF FF FFFFFFFF [FF] FF FF
                    $temp = hexdec(substr($dump, 14, 2));
                    $item->type += ((($temp & 0x80) == 0x80) ? 8 : 0);
                    $item->option += ((($temp & 0x40) == 0x40) ? 4 : 0);
                    $item->excellent[0] = (($temp & 0x01) == 0x01);
                    $item->excellent[1] = (($temp & 0x02) == 0x02);
                    $item->excellent[2] = (($temp & 0x04) == 0x04);
                    $item->excellent[3] = (($temp & 0x08) == 0x08);
                    $item->excellent[4] = (($temp & 0x10) == 0x10);
                    $item->excellent[5] = (($temp & 0x20) == 0x20);

                    // FF FF FF FFFFFFFF FF [FF] FF
                    $temp = hexdec(substr($dump, 16, 2));
                    $item->ancient = $temp;

                    $item->information = Mu_Library::getDatabase()->getItem($item->type, $item->index);

                    return $item;
                }

            /**
            * 1.02
            */
            case Mu_Version::V102:
                {
                    if($dump == str_repeat("FF", 16) || strlen($dump) != 32)
                    {
                        return null;
                    }

                    $item = new Mu_Item();

                    // [FF] FF FF FFFFFFFF FF FF FF FF FFFFFFFFFF
                    $temp = hexdec(substr($dump, 0, 2));
                    $item->index = $temp;

                    // FF [FF] FF FFFFFFFF FF FF FF FF FFFFFFFFFF
                    $temp = hexdec(substr($dump, 2, 2));
                    $item->skill = (($temp & 0x80) == 0x80);
                    $item->luck = (($temp & 0x04) == 0x04);
                    $item->level = (($temp & 0x78) >> 3);
                    $item->option = ($temp & 0x03);

                    // FF FF [FF] FFFFFFFF FF FF FF FF FFFFFFFFFF
                    $temp = hexdec(substr($dump, 4, 2));
                    $item->durability = $temp;

                    // FF FF FF [FFFFFFFF] FF FF FF FF FFFFFFFFFF
                    $temp = hexdec(substr($dump, 6, 8));
                    $item->serial = $temp;

                    // FF FF FF FFFFFFFF [FF] FF FF FF FFFFFFFFFF
                    $temp = hexdec(substr($dump, 14, 2));
                    $item->option += ((($temp & 0x40) == 0x40) ? 4 : 0);
                    $item->excellent[0] = (($temp & 0x01) == 0x01);
                    $item->excellent[1] = (($temp & 0x02) == 0x02);
                    $item->excellent[2] = (($temp & 0x04) == 0x04);
                    $item->excellent[3] = (($temp & 0x08) == 0x08);
                    $item->excellent[4] = (($temp & 0x10) == 0x10);
                    $item->excellent[5] = (($temp & 0x20) == 0x20);

                    // FF FF FF FFFFFFFF FF [FF] FF FF FFFFFFFFFF
                    $temp = hexdec(substr($dump, 16, 2));
                    $item->ancient = $temp;

                    // FF FF FF FFFFFFFF FF FF [FF] FF FFFFFFFFFF
                    $temp = hexdec(substr($dump, 18, 2));
                    $item->type = ($temp & 0xF0) >> 4;
                    $item->levelOption = (($temp & 0x08) == 0x08);

                    // FF FF FF FFFFFFFF FF FF FF [FF] FFFFFFFFFF
                    $temp = hexdec(substr($dump, 20, 2));
                    $item->harmonyType = ($temp & 0xF0) >> 4;
                    $item->harmonyLevel = ($temp & 0x0F);

                    $item->information = Mu_Library::getDatabase()->getItem($item->type, $item->index);

                    return $item;

                }

            default:
                throw new Exception("Invalid item format.");
        }
    }

    /**
    * Generates a hexadecimal string for a byte.
    */
    private function makeByte($value)
    {
        return strtoupper(str_pad(dechex(((int)$value) & 0xFF), 2, "0", STR_PAD_LEFT));
    }

    /**
    * Generates a hexadecimal string for a double word.
    */
    private function makeInt($value)
    {
        return strtoupper(str_pad(dechex(((int)$value) & 0xFFFFFFFF), 8, "0", STR_PAD_LEFT));
    }

    /**
    * Generates the binary content for the current item.
    *
    * @param int $version Destination item version.
    *
    * @return string
    */
    public function generate($version = null)
    {
        if ($version == null)
        {
            $version = Mu_Library::getVersion();
        }

        $dump = "";
        switch ($version)
        {
            case Mu_Version::V097:
                {
                    if ($this->type != -1 && $this->type != -1)
                    {
                        $dump .= $this->makeByte(
                            (($this->type & 0x0F) << 5) |
                            ($this->index & 0x1F)
                        );

                        $dump .= $this->makeByte(
                            ($this->skill ? 0x80 : 0x00) |
                            ($this->luck ? 0x04 : 0x00) |
                            (($this->level & 0x0F) << 3) |
                            ($this->option % 4)
                        );

                        $dump .= $this->makeByte(
                            $this->durability
                        );

                        $dump .= $this->makeInt(
                            $this->serial
                        );

                        $dump .= $this->makeByte(
                            ($this->type > 7 ? 0x80 : 0x00) |
                            ($this->option > 3 ? 0x40 : 0x00) |
                            ($this->excellent[0] ? 0x01 : 0x00) |
                            ($this->excellent[1] ? 0x02 : 0x00) |
                            ($this->excellent[2] ? 0x04 : 0x00) |
                            ($this->excellent[3] ? 0x08 : 0x00) |
                            ($this->excellent[4] ? 0x10 : 0x00) |
                            ($this->excellent[5] ? 0x20 : 0x00)
                        );

                        $dump .= $this->makeByte(0);
                        $dump .= $this->makeByte(0);

                        return $dump;
                    }

                    return str_repeat("FF", 10);
                }

            case Mu_Version::V099:
                {
                    if ($this->type != -1 && $this->index != -1)
                    {
                        $dump .= $this->makeByte(
                            (($this->type & 0x0F) << 5) |
                            ($this->index & 0x1F)
                        );

                        $dump .= $this->makeByte(
                            ($this->skill ? 0x80 : 0x00) |
                            ($this->luck ? 0x04 : 0x00) |
                            (($this->level & 0x0F) << 3) |
                            ($this->option % 4 )
                        );

                        $dump .= $this->makeByte(
                            $this->durability
                        );

                        $dump .= $this->makeInt(
                            $this->serial
                        );

                        $dump .= $this->makeByte(
                            ($this->type > 7 ? 0x80 : 0x00) |
                            ($this->option > 3 ? 0x40 : 0x00) |
                            ($this->excellent[0] ? 0x01 : 0x00) |
                            ($this->excellent[1] ? 0x02 : 0x00) |
                            ($this->excellent[2] ? 0x04 : 0x00) |
                            ($this->excellent[3] ? 0x08 : 0x00) |
                            ($this->excellent[4] ? 0x10 : 0x00) |
                            ($this->excellent[5] ? 0x20 : 0x00)
                        );

                        $dump .= $this->makeByte($this->ancient);
                        $dump .= $this->makeByte(0);

                        return $dump;
                    }

                    return str_repeat("FF", 10);
                }

            case Mu_Version::V102:
                {
                    if ($this->type != -1 && $this->index != -1)
                    {
                        $dump .= $this->makeByte(
                            $this->index
                        );

                        $dump .= $this->makeByte(
                            ($this->skill ? 0x80 : 0x00) |
                            ($this->luck ? 0x04 : 0x00) |
                            (($this->level & 0x0F) << 3) |
                            ($this->option % 4)
                        );

                        $dump .= $this->makeByte(
                            $this->durability
                        );

                        $dump .= $this->makeInt(
                            $this->serial
                        );

                        $dump .= $this->makeByte(
                            ($this->option > 3 ? 0x40 : 0x00) |
                            ($this->excellent[0] ? 0x01 : 0x00) |
                            ($this->excellent[1] ? 0x02 : 0x00) |
                            ($this->excellent[2] ? 0x04 : 0x00) |
                            ($this->excellent[3] ? 0x08 : 0x00) |
                            ($this->excellent[4] ? 0x10 : 0x00) |
                            ($this->excellent[5] ? 0x20 : 0x00)
                        );

                        $dump .= $this->makeByte (
                            $this->ancient
                        );

                        $dump .= $this->makeByte (
                            (($this->type & 0x0F) << 4) |
                            ($this->levelOption ? 0x08 : 0x00)
                        );

                        $dump .= $this->makeByte (
                            (($this->harmonyType & 0x0F) << 4) |
                            ($this->harmonyLevel & 0x0F)
                        );

                        $dump .= $this->makeByte(0);
                        $dump .= $this->makeByte(0);
                        $dump .= $this->makeByte(0);
                        $dump .= $this->makeByte(0);
                        $dump .= $this->makeByte(0);

                        return $dump;
                    }

                    return str_repeat("FF", 16);
                }

            default:
                throw new Exception("Invalid output item format.");
        }
    }

    /**
    * Gets the item description.
    *
    * @return Mu_Item_Information
    */
    public function getInformation()
    {
        return $this->information;
    }

    /**
    * Gets whether the item is excellent or not.
    *
    * @return bool
    */
    public function isExcellent()
    {
        for ($i = 0; $i < 6; $i++)
        {
            if($this->excellent[$i] == true)
            {
                return true;
            }
        }
        return false;
    }

    /**
    * Describes the current item as a string.
    *
    * @return string
    */
    public function describe($serial = false)
    {
        $info = $this->getInformation();
        if ($info != null)
        {
            $description = $info->getName();
        }
        else
        {
            $description = "[" . $this->type . ", " . $this->index . "]";
        }

        $description .= " +" . $this->level;

        if ($this->skill)
        {
            $description .= " +Skill";
        }

        if ($this->luck)
        {
            $description .= " +Luck";
        }

        if ($this->isExcellent())
        {
            $description = "Excellent " . $description;
        }

        /*
        $description .= "\n";
        for ($i = 0;  $i < 6; $i++)
        {
            if ($this->excellent[$i])
            {
                $description .= "+Ex" . ($i + 1) . "\n";
            }
        }
        */

        if ($serial)
        {
            $description .= " (Serial = " . $this->makeInt($this->serial) . ")";
        }

        return $description;
    }
}
