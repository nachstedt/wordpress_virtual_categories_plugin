<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class etax_Options
{
    public static function add_taxonomy($data)
    {
        $db_entry = self::get_db_entry();
        if (!array_key_exists('additional', $db_entry))
            $db_entry["additional"] = array();
        $db_entry["additional"][$data["name"]] = array(
            "name" => $data["name"],
            "labels" => array(
                "name" => $data["label"]
                )
            );
        self::save_db_entry($db_entry);
    }
    
    public static function get_additional_taxonomies()
    {
        $db_entry = self::get_db_entry();
        return $db_entry["additional"];
    }
    
    public static function get_disabled_builtin_taxonomies()
    {
        $disabled_taxonomies = array();
        foreach (self::get_builtin_options() as $taxonomy_name => $options)
        {
            if (self::arr_get($options, "disabled", False))
            {
                $disabled_taxonomies[] = $taxonomy_name;
            }
        }
        return $disabled_taxonomies;
    }
    
    public static function get_builtin_taxonomy_options($taxonomy_name)
    {
        $db_options = self::arr_get(
                self::get_builtin_options(),
                $taxonomy_name, 
                array());
        $options["disabled"] = self::arr_get($db_options, "disabled", FALSE);
        return $options;
    }
    
    public static function get_taxonomy_options($taxonomy_name)
    {
        $data = self::arr_get(
                self::get_additional_taxonomies(), 
                $taxonomy_name, 
                array());
        $options["disabled"] = self::arr_get($data, "disabled", FALSE);
        $options["labels"] = array();
        $labels_data = self::arr_get($data, "labels", array());
        foreach (array(
            'name', 'singular_name', 'menu_name', 'all_items', 
            'edit_item', 'view_item', 'update_item', 'add_new_item', 
            'new_item_name', 'parent_item', 'parent_item_colon', 'search_items',
            'popular_items', 'separate_items_with_commas', 
            'add_or_remove_items', 'choose_from_most_used', 'not_found') 
                as $label)
        {
            $options['labels'][$label] = self::arr_get($labels_data, $label);
        }
        return $options;
    }
    
    public static function set_builtin_taxonomy_options($taxonomy_name, $options)
    {
        $db_options = array();
        $db_options["disabled"] = self::arr_get($options, "disabled", False);
        $db_entry = self::get_db_entry();
        $db_entry["builtin"] = self::get_builtin_options();
        $db_entry["builtin"][$taxonomy_name] = $db_options;
        self::save_db_entry($db_entry);
    }
 
    public static function set_taxonomy_options($taxonomy_name, $options)
    {
        $db_options = array();
        $db_options["disabled"] = self::arr_get($options, "disabled", False);
        $db_options["name"] = $options['name'];
        $labels = array();
        if (isset ($options["labels"]["name"]))
            $labels['name'] = $options['labels']["name"];
        $db_options["labels"] = $labels;
        $db_entry = self::get_db_entry();
        $db_entry["additional"] = self::get_additional_taxonomies();
		unset ($db_entry["additional"][$taxonomy_name]);
        $db_entry["additional"][$db_options["name"]] = $db_options;
        self::save_db_entry($db_entry);
    }
    
    private static $db_entry = NULL;
  
    private static function arr_get($array, $key, $default=NULL) {
        return isset($array[$key]) ? $array[$key] : $default;
    }
 
    public static function get_builtin_options()
    {
        return self::arr_get(self::get_db_entry(), "builtin", array());
    }
    
    public static function get_db_entry()
    {
        if (self::$db_entry == NULL)
        {
            self::$db_entry = get_option("etax_settings", array());
        }
        return self::$db_entry;
    }
    
    public static function save_db_entry($db_entry)
    {
        update_option("etax_settings", $db_entry);
        self::$db_entry = $db_entry;
    }
}
