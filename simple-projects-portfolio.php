<?php
/*
 Plugin Name: Simple Projects Portfolio
 Description: Easily showcase your services, products, projects or anything else anywhere on your site.
 Version:     1.1
 Author:      Corporate Zen
 Author URI:  http://www.corporatezen.com/
 License:     GPL2
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 
 Simple Projects Portfolio is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 2 of the License, or
 any later version.
 
 Simple Projects Portfolio is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with Simple Projects Portfolio. If not, see https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) or die( 'Direct access to this code is not allowed.' );

require_once 'settings.php';
require_once 'layout1.php';
require_once 'layout2.php';

//==================================================================================
// Register Custom Post Type
//==================================================================================
function simple_pp_setup_cpt() {
	
	$labels = array(
			'name'                  => 'Projects',
			'singular_name'         => 'Project',
			'menu_name'             => 'Projects',
			'name_admin_bar'        => 'Project',
			'archives'              => 'Project Archives',
			'attributes'            => 'Project Attributes',
			'parent_item_colon'     => 'Parent Project:',
			'all_items'             => 'All Projects',
			'add_new_item'          => 'Add New Project',
			'add_new'               => 'Add New',
			'new_item'              => 'New Project',
			'edit_item'             => 'Edit Project',
			'update_item'           => 'Update Project',
			'view_item'             => 'View Project',
			'view_items'            => 'View Projects',
			'search_items'          => 'Search Projects',
			'not_found'             => 'Not found',
			'not_found_in_trash'    => 'Not found in Trash',
			'featured_image'        => 'Featured Image',
			'set_featured_image'    => 'Set featured image',
			'remove_featured_image' => 'Remove featured image',
			'use_featured_image'    => 'Use as featured image',
			'insert_into_item'      => 'Insert into Project',
			'uploaded_to_this_item' => 'Uploaded to this Project',
			'items_list'            => 'Project list',
			'items_list_navigation' => 'Projects list navigation',
			'filter_items_list'     => 'Filter Project list'
	);
	
	$args = array(
			'label'                 => 'Project',
			'description'           => 'A service/product/item you want to showcase on your site',
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'page-attributes'),
			'taxonomies'            => array( 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 30,
			'menu_icon'             => 'dashicons-format-gallery',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
	);
	
	register_post_type( 'spp_project', $args );
	
}
add_action( 'init', 'simple_pp_setup_cpt', 0 );

//==================================================================================
// Enqueue main js file
//==================================================================================
function simple_pp_adding_scripts() {
	wp_register_script('spp_sameheight_js_plugin', plugins_url('js/jquery.matchHeight.js', __FILE__), array('jquery'),'1.0', true);
	wp_enqueue_script('spp_sameheight_js_plugin');
	
	wp_register_script('spp_main_js', plugins_url('js/main.js', __FILE__), array('jquery'),'1.0', true);
	wp_enqueue_script('spp_main_js');
}

add_action( 'wp_enqueue_scripts', 'simple_pp_adding_scripts' );  

//==================================================================================
// Enqueue grid css
//==================================================================================
function simple_pp_theme_styles() {
	wp_enqueue_style( 'grid_style', plugin_dir_url( __FILE__ ) . 'css/grid.css' );
}
add_action( 'wp_enqueue_scripts', 'simple_pp_theme_styles');

?>