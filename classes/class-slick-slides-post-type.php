<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Slick_Slides_Post_Type {
	
	function __construct() {
		$this->init();
		$this->add_image_sizes();
	}

	private function init(){
		add_action('init', array($this, 'codex_slide_init' ));
		add_action('init', array($this, 'create_slide_taxonomies'));
		add_filter('manage_slide_posts_columns', array($this, 'add_slide_columns' ));
		add_action('manage_posts_custom_column', array($this, 'slide_custom_columns' ));
		add_action('init', array($this, 'add_image_sizes'));
	}

	/**
	 * Register a slide post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	public function codex_slide_init() {
		$labels = array(
			'name'               => _x( 'Slides', 'post type general name', 'dei' ),
			'singular_name'      => _x( 'Slide', 'post type singular name', 'dei' ),
			'menu_name'          => _x( 'Slides', 'admin menu', 'dei' ),
			'name_admin_bar'     => _x( 'Slide', 'add new on admin bar', 'dei' ),
			'add_new'            => _x( 'Add New', 'Slide', 'dei' ),
			'add_new_item'       => __( 'Add New Slide', 'dei' ),
			'new_item'           => __( 'New Slide', 'dei' ),
			'edit_item'          => __( 'Edit Slide', 'dei' ),
			'view_item'          => __( 'View Slide', 'dei' ),
			'all_items'          => __( 'All Slides', 'dei' ),
			'search_items'       => __( 'Search slides', 'dei' ),
			'parent_item_colon'  => __( 'Parent slides:', 'dei' ),
			'not_found'          => __( 'No slides found.', 'dei' ),
			'not_found_in_trash' => __( 'No slides found in Trash.', 'dei' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'slide' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 12,
			'menu_icon'			 => 'dashicons-images-alt2',
			'show_in_rest'       => true,
			'rest_base'          => 'slides-api',
			'rest_controller_class' => 'Slick_Slides_Post_REST_Controller',
			'supports'           => array( 'title', 'thumbnail','page-attributes', 'editor' )
		);

		register_post_type( 'slide', $args );
	}

	function create_slide_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Slide Gallery', 'taxonomy general name' ),
			'singular_name'     => _x( 'Slide Gallery', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Slide Gallery' ),
			'all_items'         => __( 'All Slide Gallery' ),
			'parent_item'       => __( 'Parent Slide Gallery' ),
			'parent_item_colon' => __( 'Parent Slide Gallery:' ),
			'edit_item'         => __( 'Edit Slide Gallery' ),
			'update_item'       => __( 'Update Slide Gallery' ),
			'add_new_item'      => __( 'Add New Slide Gallery' ),
			'new_item_name'     => __( 'New Slide Gallery Name' ),
			'menu_name'         => __( 'Slide Galleries' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => false,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'slide-gallery' ),
			'show_in_rest'       => true,
		  	'rest_base'          => 'slide-gallery',
		  	'rest_controller_class' => 'WP_REST_Terms_Controller',
		);

		register_taxonomy( 'slide-gallery', array( 'slide' ), $args );
	}

	function add_slide_columns($columns) {
	    unset($columns['author']);
	    unset($columns['date']);
	    return array_merge($columns,
	          array( 'slide_order' => 'Order', 'slide_thumbnail' => 'Image'));
	}

	function slide_custom_columns( $column_name ) {
	  global $post;
	  if ( $column_name == 'slide_thumbnail' ) {
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			if ( $post_thumbnail_id ) {
				$post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
				echo '<img style="width: 100px;" src="' . $post_thumbnail_img[0] . '" />';
			}
		}
		if ( $column_name == 'slide_order' ) {
			$order = get_post_field( 'menu_order', $post->ID );
			echo '<a class="editinline">'.$order.' <i>(edit)</i></a>';
		}
	}

	function add_image_sizes(){
	 /**
	 * Register a slide post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_image_size
	 */

		add_image_size( 'carousel-lg-2x', 2340, 1000, true ); //
		add_image_size( 'carousel-lg', 1170, 500, true );
		add_image_size( 'carousel-sm', 768, 450, true );
	}

}

$slick_slides_post_type =	new Slick_Slides_Post_Type();

