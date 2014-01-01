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
        $taxonomy_name = $_REQUEST["taxonomy"];
        global $tn_enhanced_taxonomies_plugin;
        $builtin = array_key_exists(
                $taxonomy_name, 
                $tn_enhanced_taxonomies_plugin->get_original_taxonomies());
        $options = $builtin 
                ? etax_Options::get_builtin_taxonomy_options($taxonomy_name)
                : etax_Options::get_taxonomy_options($taxonomy_name);
        $args = array(
            "name" => $taxonomy_name,
            "builtin" => $builtin,
            "form-url" => add_query_arg(
                array("page" => "taxonomy_edit"),
                get_admin_url(0, 'admin.php')),
            "disabled" => $options["disabled"]
        );
        etax_Templates::taxonomy_edit($args);
    }
    
    public static function display_overview()
    {
        global $tn_enhanced_taxonomies_plugin;
        $args["form-url"] = add_query_arg(
                array("page" => "taxonomy_edit"),
                get_admin_url(0, 'admin.php'));
        $args["builtin_taxonomies"] = array();
        $original = $tn_enhanced_taxonomies_plugin->get_original_taxonomies();
        foreach ($original as $taxonomy)
        {
            $options = etax_Options::get_builtin_taxonomy_options($taxonomy->name);
            $data = array();
            $data["name"] = $taxonomy->name;
            $data["url"] = add_query_arg(
                array(
                    "page" => "taxonomy_edit",
                    "action" => "edit",
                    "taxonomy" => $taxonomy->name
                ),
                get_admin_url(0, "admin.php"));
            $data["disabled"] = $options["disabled"];
            $args["builtin_taxonomies"][] = $data;
        }
        etax_Templates::taxonomy_manager_overview($args);
    }
    
    public static function taxonomies_menu_page_callback() 
    {
                
        $action = array_key_exists("action", $_REQUEST) ? $_REQUEST["action"] : "overview";

        switch ($action) 
        {
            case "add-taxonomy":
                $data["name"] = $_REQUEST["taxonomy-slug"];
                $data["label"] = $_REQUEST["taxonomy-label-name"];
                $data["type"] = $_REQUEST["taxonomy-type"];
                etax_Options::add_taxonomy($data);
                wp_redirect(add_query_arg(
                    array(
                        "page" => "taxonomy_edit",
                        "action" => "edit",
                        "taxonomy" => $data["name"]),
                    get_admin_url(0, 'admin.php')));                
            case "edit":
                self::display_edit_form();
                break;
            case 'overview':
                self::display_overview();
                break;
            case 'save':
                $taxonomy_name = $_REQUEST["taxonomy"];
                $options["disabled"] = array_key_exists("disabled", $_REQUEST);
                etax_Options::set_builtin_taxonomy_options(
                        $taxonomy_name, 
                        $options);
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