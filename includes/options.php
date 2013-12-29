<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class etax_Options
{
    public static function get_disabled_taxonomies()
    {
        $db_entry = self::get_db_entry();
        $disabled_taxonomies = array();
        foreach ($db_entry as $taxonomy_name => $options)
        {
            if (self::arr_get($options, "disabled", False))
            {
                $disabled_taxonomies[] = $taxonomy_name;
            }
        }
        return $disabled_taxonomies;
    }
    
    public static function get_taxonomy_options($taxonomy_name)
    {
        $db_options = self::arr_get(
                self::get_db_entry(), 
                $taxonomy_name, 
                array());
        $options["disabled"] = self::arr_get($db_options, "disabled", FALSE);
        return $options;
    }
   
    private static function arr_get($array, $key, $default) {
        return isset($array[$key]) ? $array[$key] : $default;
    }
 
    private static $db_entry = NULL;

    private static function get_db_entry()
    {
        if (self::$db_entry == NULL)
        {
            self::$db_entry = get_option("etax_settings", array());
        }
        return self::$db_entry;
    }
}
