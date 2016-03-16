<?php

/**
 * @package 	MuItem
 * @link 		https://github.com/WoLfulus/MuItem
 * @copyright 	WoLfulus
 * @license 	GNU General Public License 2, see LICENSE
 */

require 'src/Load.php';

echo "<pre>";

/**
 * Loads item(kor).txt
 */
Mu_Library::initialize(__DIR__ . '/data/item(kor)_97d.txt', Mu_Version::V097, false);

/**
 * Parses an item's dump
 */
$item = Mu_Item::parse('AA5F7F0000000A7F0000', Mu_Version::V097);

/**
 * Shows item information
 */
echo $item->describe() . "\n";
echo $item->describe(true) . "\n"; // Showing serial is optional

echo "\n";

echo "<strong>Warehouse Contents</strong>\n\n";

/**
 * Load inventory
 */
$warehouse = file_get_contents(__DIR__ . '/data/warehouse_97d.txt');
for ($i = 0; $i < 120; $i++)
{
    $dump = substr($warehouse, $i * 20, 20);
    $item = Mu_Item::parse($dump);
    if ($item != null)
    {
        echo $item->describe() . "\n";
    }
}

echo "</pre>";
