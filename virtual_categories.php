<?php
/*
Plugin Name: Virtual Categories
Plugin URI: http://www.nachstedt.com/en/divisions-wordpress-plugin-en
Description: TBA
Version: 0.1.0
Author: Timo Nachstedt
Author URI: http://www.nachstedt.com
License: GPL2
*/

function tn_virtual_categories_pre_get_posts($query)
{
	if ( $query->is_main_query() && array_key_exists("cat", $query->query)) {
		if ($query->query["cat"]=="5") 
		{ 
			$query->query["cat"]="4"; 
			$query->query_vars["cat"]="4"; 
		}
	}
}

add_action('pre_get_posts', 'tn_virtual_categories_pre_get_posts');


function tn_virtual_categories_get_terms_filter($cache, $taxonomies, $args)
{
	if (!in_array("category", $taxonomies)) return $cache;
	foreach ($cache as $id=>$term)
	{
		if ($term->term_id == "16") 
		{
			unset($cache[$id]);
		}
	}
//	$test = new stdClass;
//	$test->term_id = "550";
//	$test->name = "Timo";
//	$test->slug = "timo";
//	$test->term_group = "0";
//	$test->term_taxonomy_id = 550;
//	$test->taxonomy = "category";
//	$test->description = "test description";
//	$test->parent = "0";
//	$test->count = "0";
	//$cache[] = $test;
	//var_dump($args);
	//var_dump($cache);
	return $cache;
}

add_filter("get_terms", "tn_virtual_categories_get_terms_filter", 10, 3);
