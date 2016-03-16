<?php

/**
 * @package 	MuItem
 * @link 		https://github.com/WoLfulus/MuItem
 * @copyright 	WoLfulus
 * @license 	GNU General Public License 2, see LICENSE
 */

/**
* General management class.
*/
class Mu_Library
{
    /**
    * Database version.
    *
    * @var mixed
    */
    private static $version = 1;

    /**
    * Item information database.
    *
    * @var Mu_Item_Database
    */
    private static $database = null;

    /**
    * Item cache path.
    *
    * @var string
    */
    private static $path = null;

    /**
    * Gets the default database version.
    *
    */
    public static function getVersion()
    {
        return Mu_Library::$version;
    }

    /**
    * Gets the default database version.
    *
    */
    public static function & getDatabase()
    {
        return Mu_Library::$database;
    }

    /**
    * Initializes the library.
    *
    */
    public static function initialize($path, $version = Mu_Version::V097, $loadCache = true)
    {
        Mu_Library::$path = $path;
        Mu_Library::$version = $version;

        $cache = Mu_Library::$path . '.cache';

        Mu_Library::$database = new Mu_Item_Database();
        if ($loadCache)
        {
            if (file_exists($cache))
            {
                if (Mu_Library::$database->load($cache))
                {
                    return true;
                }
            }
        }

        $success = Mu_Library::$database->read(Mu_Library::$path, Mu_Library::$version);
        if ($success)
        {
            Mu_Library::$database->save($cache);
            return true;
        }

        return false;
    }
}
