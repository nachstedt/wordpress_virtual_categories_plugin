<?php
/*
Plugin Name: Enhanced Taxonomies
Plugin URI: http://www.nachstedt.com/en/divisions-wordpress-plugin-en
Description: TBA
Version: 0.0.1
Author: Timo Nachstedt
Author URI: http://www.nachstedt.com
License: GPL2
*/

require_once(plugin_dir_path( __FILE__ ) . 'includes/taxonomy_manager.php');
require_once(plugin_dir_path( __FILE__ ) . 'includes/options.php');
require_once(plugin_dir_path( __FILE__ ) . 'includes/templates.php');


class TN_Enhanced_Taxonomies_Plugin
{
    private $original_taxonomies = NULL;
    
    public function __construct() 
    {
        $this->register_hooks();
        etax_TaxonomyManager::register_hooks();
    }
    
    public function get_original_taxonomies()
    {
        return $this->original_taxonomies;
    }
    
    public function init_hook()
    {
        $this->original_taxonomies = get_taxonomies(array(), "objects");
        foreach (etax_Options::get_disabled_builtin_taxonomies() as $taxonomy_name)
        {
            register_taxonomy($taxonomy_name, array());
        }
        foreach (etax_Options::get_additional_taxonomies() as $taxonomy)
        {
            register_taxonomy(
                    $taxonomy["name"],
                    'post',
                    array(
                        "labels"=> $taxonomy["labels"]
                        )
                    );
        }
    }
    
    public function register_hooks() 
    {
        add_action('init', array($this, 'init_hook'));
    }    
}

$tn_enhanced_taxonomies_plugin = new TN_Enhanced_Taxonomies_Plugin();


//function tn_virtual_categories_pre_get_posts($query)
//{
//    if ( $query->is_main_query() && array_key_exists("timo", $query->query)) {
//        var_dump($query);
//        if ($query->query["timo"]=="timos_first") 
//        { 
//            //unset($query->query_vars["timo"]);
//            //$query->query_vars["cat"]="4"; 
//            //$query->tax_query->queries[0]["taxonomy"] = "category";
//            //$query->tax_query->queries[0]["terms"][0] = "4";
//            //$query->tax_query->queries[0]["field"] = "id";            
// 
//            $taxquery = array(
//                array(
//                    'taxonomy' => 'verband',
//                    'field' => 'id',
//                    'terms' => array( 23 ),
//                    'operator'=> 'IN'
//                ),
//                array(
//                    'taxonomy' => 'inhaltstyp',
//                    'field' => 'id',
//                    'terms' => array( 8 ),
//                    'operator'=> 'IN'
//                )
//            );
//            $query->tax_query->queries = $taxquery;
//            $query->query_vars['tax_query'] = $taxquery;
//            unset($query->query_vars["timo"]);
//
//        }
//        var_dump($query);
//    }
//}
//
//add_action('pre_get_posts', 'tn_virtual_categories_pre_get_posts');
//
//
//function tn_virtual_categories_get_terms_filter($cache, $taxonomies, $args)
//{
//	if (!in_array("category", $taxonomies)) return $cache;
//	foreach ($cache as $id=>$term)
//	{
//		if ($term->term_id == "16") 
//		{
//			unset($cache[$id]);
//		}
//	}
//	return $cache;
//}
//
////add_filter("get_terms", "tn_virtual_categories_get_terms_filter", 10, 3);
//
//function tn_virtual_categories_init_filter()
//{
//    register_taxonomy(
//        'verband', // taxonomy name in slug form
//        'post',             // object type
//        array(            // arguments
//            "label" => __("Verband"),
//            "public" => TRUE,
//            "show_ui" => TRUE,
//            "show_in_nav_menus" => TRUE,
//            "show_tagcloud" => TRUE,
//            "meta_box_cb" => NULL,
//            "show_admin_column" => FALSE,
//            "hierarchical" => TRUE,
//            "update_count_callback" => NULL,
//            "query_var" => "verband",
//            "rewrite" => TRUE,
//            "capabilities" => array(),
//            "sort" => NULL
//        ));
//
//    register_taxonomy(
//        'inhaltstyp', // taxonomy name in slug form
//        'post',             // object type
//        array(            // arguments
//            "label" => __("Inhaltstyp"),
//            "public" => TRUE,
//            "show_ui" => TRUE,
//            "show_in_nav_menus" => TRUE,
//            "show_tagcloud" => TRUE,
//            "meta_box_cb" => NULL,
//            "show_admin_column" => FALSE,
//            "hierarchical" => TRUE,
//            "update_count_callback" => NULL,
//            "query_var" => "inhaltstyp",
//            "rewrite" => TRUE,
//            "capabilities" => array(),
//            "sort" => NULL
//        ));
//    
//    register_taxonomy(
//        'timos_taxonomy', // taxonomy name in slug form
//        'post',             // object type
//        array(            // arguments
//            "label" => __("Timos taxonomy"),
//            "public" => TRUE,
//            "show_ui" => TRUE,
//            "show_in_nav_menus" => TRUE,
//            "show_tagcloud" => TRUE,
//            "meta_box_cb" => NULL,
//            "show_admin_column" => FALSE,
//            "hierarchical" => FALSE,
//            "update_count_callback" => NULL,
//            "query_var" => "timo",
//            "rewrite" => TRUE,
//            "capabilities" => array(),
//            "sort" => NULL
//        ));
//}
//
//add_action('init', 'tn_virtual_categories_init_filter');
//
//
//function tn_virtual_categories_admin_menu_hook() 
//{
//	remove_meta_box( 'tagsdiv-timos_taxonomy' , 'post' , 'side' );
//    
//}
//add_action( 'admin_menu' , 'tn_virtual_categories_admin_menu_hook' );
