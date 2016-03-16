<?php

/**
 * @package 	MuItem
 * @link 		https://github.com/WoLfulus/MuItem
 * @copyright 	WoLfulus
 * @license 	GNU General Public License 2, see LICENSE
 */

/**
* Item information database.
*/
class Mu_Item_Database
{
    /**
    * Stores all item informations.
    *
    * @var mixed
    */
    private $items = null;

    /**
    * Creates a database instance.
    */
    public function __construct()
    {
    }

    /**
    * Gets an item from the database.
    *
    * @return Mu_Item_Information
    */
    public function getItem($type, $index)
    {
        if (isset($this->items[$type][$index]))
        {
            return $this->items[$type][$index];
        }
        return false;
    }

    /**
    * Gets all items of a section from the database.
    *
    * @return array Mu_Item_Information
    */
    public function getItems($type)
    {
        if (isset($this->items[$type]))
        {
            return $this->items[$type];
        }
        return false;
    }

    /**
    * Gets all items from the database.
    *
    * @return array Mu_Item_Information
    */
    public function getAllItems()
    {
        return $this->items;
    }

    /**
    * Try loading content from a file.
    *
    * @param mixed $file
    */
    public function load($file)
    {
        if (file_exists($file) && is_readable($file))
        {
            $contents = file_get_contents($file);
            if ($contents !== false)
            {
                $this->items = @unserialize($contents);
                if (!$this->items)
                {
                    return false;
                }
                return true;
            }
        }
        return false;
    }

    /**
    * Try loading content from a file.
    *
    * @param mixed $file
    */
    public function save($file)
    {
        if (file_exists($file))
        {
            unlink($file);
        }
        if (file_put_contents($file, serialize($this->items)) !== false)
        {
            return true;
        }
        return false;
    }

    /**
    * Try loading content from a file.
    *
    * @param mixed $file
    */
    public function read($file, $version = Mu_Version::V097)
    {
        if (file_exists($file) && is_readable($file))
        {
            $contents = file_get_contents($file);
            $contents = str_replace("\r", "\n", $contents);
        }
        else
        {
            throw new Exception("Cannot find file '" . $file . "'");
        }

        $token = "";
        $tokens = array();
        $comment = false;
        $str = false;

        $position = 0;

        while ($position < strlen($contents))
        {
            $char = $contents[$position];
            $position++;

            if ($comment == true)
            {
                if ($char == "\n")
                {
                    $comment = false;
                }
                continue;
            }

            if ($str == true)
            {
                if ($char == '"')
                {
                    $tokens[] = $token;
                    $token = "";
                    $str = false;
                }
                else
                {
                    $token .= $char;
                }
            }
            else
            {
                if ($char == '"')
                {
                    $str = true;
                    $token = "";
                }
                else if ($char == ' ' || $char == "\t" || $char == "\n" || $char == "\r")
                {
                    if ($token != "")
                    {
                        $tokens[] = $token;
                        $token = "";
                    }
                }
                else
                {
                    $token .= $char;
                    if ($token == "//")
                    {
                        $comment = true;
                        $token = "";
                    }
                }
            }
        }

        if ($token != "")
        {
            $tokens[] = $token;
        }

        switch ($version)
        {
            case Mu_Version::V097:
                return $this->parse097($tokens);
            case Mu_Version::V099:
                return $this->parse099($tokens);
            case Mu_Version::V102:
                return $this->parse102($tokens);
            default:
                throw new Exception("Invalid item version.");
        }

        return false;
    }

    /**
    * Parses the 0.97 tokens.
    *
    * @param mixed $tokens
    */
    private function parse097($tokens)
    {
        $items = array();

        while (!empty($tokens))
        {
            $type = array_shift($tokens);

            while (!empty($tokens))
            {
                $item = new Mu_Item_Information();
                $item->setType($type);

                $index = array_shift($tokens);
                if ($index == "end")
                {
                    break;
                }

                $item->setIndex($index);

                $item->setWidth(array_shift($tokens));
                $item->setHeight(array_shift($tokens));

                array_shift($tokens);
                array_shift($tokens);
                array_shift($tokens);

                $item->setName(array_shift($tokens));

                if ($type >= 0 && $type <= 5)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type == 6)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type >= 7 && $type <= 11)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type == 12)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type == 13)
                {
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type == 14)
                {
                    $item->setDurability(0);
                    array_shift($tokens);
                    array_shift($tokens);
                }
                else if ($type == 15)
                {
                    $item->setDurability(0);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }

                $items[$item->getType()][$item->getIndex()] = $item;
            }
        }

        $this->items = $items;
        return true;
    }

    /**
    * Parses the 0.99 tokens.
    *
    * @param mixed $tokens
    */
    private function parse099($tokens)
    {
        $items = array();

        while (!empty($tokens))
        {
            $type = array_shift($tokens);
            while (!empty($tokens))
            {
                $item = new Mu_Item_Information();
                $item->setType($type);

                $index = array_shift($tokens);
                if ($index == "end")
                {
                    break;
                }

                $item->setIndex($index);

                $item->setWidth(array_shift($tokens));
                $item->setHeight(array_shift($tokens));

                array_shift($tokens);
                array_shift($tokens);
                array_shift($tokens);

                $item->setName(array_shift($tokens));

                if ($type >= 0 && $type <= 5)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type == 6)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type >= 7 && $type <= 11)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type == 12)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                    array_shift($tokens);
                }
                else if ($type == 13)
                {
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }
                else if ($type == 14)
                {
                    $item->setDurability(0);
                    array_shift($tokens);
                    array_shift($tokens);
                }
                else if ($type == 15)
                {
                    $item->setDurability(0);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                }

                $items[$item->getType()][$item->getIndex()] = $item;
            }
        }

        $this->items = $items;
        return true;
    }

    /**
    * Parses the 1.02 tokens.
    *
    * @param mixed $tokens
    */
    private function parse102($tokens)
    {
        $items = array();

        while (!empty($tokens))
        {
            $type = array_shift($tokens);
            while (!empty($tokens))
            {
                $item = new Mu_Item_Information();
                $item->setType($type);

                $index = array_shift($tokens);
                if ($index == "end")
                {
                    break;
                }

                $item->setIndex($index);

                array_shift($tokens); // slot
                array_shift($tokens); // skill

                $item->setWidth(array_shift($tokens));
                $item->setHeight(array_shift($tokens));

                array_shift($tokens);
                array_shift($tokens);
                array_shift($tokens);

                $item->setName(array_shift($tokens));

                if ($type >= 0 && $type <= 5)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                    array_shift($tokens); // DL
                }
                else if ($type == 6)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                    array_shift($tokens); // DL
                }
                else if ($type >= 7 && $type <= 11)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                    array_shift($tokens); // DL
                }
                else if ($type == 12)
                {
                    array_shift($tokens);
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                    array_shift($tokens); // DL
                }
                else if ($type == 13)
                {
                    array_shift($tokens);
                    $item->setDurability(array_shift($tokens));
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                    array_shift($tokens); // DL
                }
                else if ($type == 14)
                {
                    $item->setDurability(0);
                    array_shift($tokens);
                    array_shift($tokens);
                }
                else if ($type == 15)
                {
                    $item->setDurability(0);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens);
                    array_shift($tokens); // DW
                    array_shift($tokens); // DK
                    array_shift($tokens); // ELF
                    array_shift($tokens); // MG
                    array_shift($tokens); // DL
                }

                $items[$item->getType()][$item->getIndex()] = $item;
            }
        }

        $this->items = $items;
        return true;
    }
}
