<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class etax_TaxonomyManager
{
    public static function register_hooks()
    {
        add_action(
                'admin_menu',
                array(__CLASS__, 'admin_menu_hook'));

    }
    
    public static function admin_menu_hook() 
    {
        add_menu_page(
            "Taxonomies",                                      // page title
            "Taxonomies",                                      // menu title
            "manage_options",                                  // capability
            "taxonomy_edit",                                   // menu slug
            array(__CLASS__, "taxonomies_menu_page_callback"), // callback
            "",                                                // icon_url
            101                                                // menu position
        );        
    }
    
    public static function display_edit_form()
    {
        $taxonomy = get_taxonomy($_REQUEST["taxonomy"]);
        $options = etax_Options::get_taxonomy_options($taxonomy->name);
        $url = add_query_arg(
                array("page" => "taxonomy_edit"),
                get_admin_url(0, 'admin.php'));
        echo "<h2>{$taxonomy->labels->name}</h2>\n";
        echo "<form action='$url' method='post'>\n";
        echo "<input type='hidden' name='action' value='save'/>";
        echo "<input type='hidden' name='taxonomy' value='{$taxonomy->name}' />";
        echo "<input type='hidden' name='noheader' value='1' />";
        $checked = $options["disabled"] ? "checked" : "";
        echo "<input type='checkbox' name='disabled' $checked/> disabled";
        echo "<input type='submit' value='Update' />";
        echo "</form>\n";        
    }
    
    public static function display_overview()
    {
        $taxonomies = get_taxonomies(array(), "options", "AND");
        echo '<div class="wrap">';
        echo '<h2>Taxonomies</h2>';
        echo '<table class="widefat">';
        echo "<thead>\n";
        echo "<tr>\n";
        echo "<th>Name</th>\n";
        echo "<th>Builtin</th>\n";
        echo "<th>Disabled</th>\n";
        echo "</tr>\n";
        echo "</thead>\n";
        echo "<tbody>\n";
        foreach ($taxonomies as $taxonomy)
        {
            $options = etax_Options::get_taxonomy_options($taxonomy->name);
            $url =  add_query_arg(
                        array(
                            "page" => "taxonomy_edit",
                            "action" => "edit",
                            "taxonomy" => $taxonomy->name
                        ),
                        get_admin_url(0, "admin.php"));
            echo '<tr class="alternate">';
            echo "<td><a href='$url'> {$taxonomy->name} </td>\n";
            echo "<td>" . ($taxonomy->_builtin ? "yes" : "no"). "</td>\n";
            echo "<td>" . ($options["disabled"] ? "yes" : "no"). "</td>\n";
            echo "<tr>\n";
        }
        echo "</tbody>\n";
        echo "</table>\n";
        echo "</div>";
    }
    
    public static function taxonomies_menu_page_callback() 
    {
                
        $action = array_key_exists("action", $_REQUEST) ? $_REQUEST["action"] : "overview";

        switch ($action) 
        {
            case 'overview':
                self::display_overview();
                break;
            case "edit":
                self::display_edit_form();
                break;
            case 'save':
                $taxonomy = get_taxonomy($_REQUEST["taxonomy"]);
                $options = get_option("etax_settings", array());
                if (!array_key_exists($taxonomy->name, $options))
                    $options[$taxonomy->name] = array();
                $options[$taxonomy->name]["disabled"] = array_key_exists("disabled", $_REQUEST);
                update_option("etax_settings", $options);
                $url =  add_query_arg(
                    array(
                        "page" => "taxonomy_edit",
                        "action" => "overview"),
                    get_admin_url(0, 'admin.php'));                
                wp_redirect($url);
                exit;
            default:
                $url = get_admin_url(0, 'admin.php');
                wp_redirect($url);
                exit;
        }
        
        
    }
  
}