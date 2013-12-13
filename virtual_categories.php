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
	if ( $query->is_main_query() ) {
		if ($query->query["cat"]=="5") 
		{ 
			$query->query["cat"]="4"; 
			$query->query_vars["cat"]="4"; 
		}
	}
}

add_action('pre_get_posts', 'tn_virtual_categories_pre_get_posts');
