<?php
// exit if file is called directly
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Slick_Slider_Post_Admin_Page{

	public function __construct(){
		$this->init();
	}

	private function init(){
		add_action('admin_menu', array($this, 'register_custom_menu_page'));
	}


	public function register_custom_menu_page(){
	    add_submenu_page( 'edit.php?post_type=slide', 'How to use - Slick Slider Post and Shortcode', 'How to use', 'manage_options', 'slick-slider-post', array($this, 'custom_menu_page') ); 
	}

	public function custom_menu_page(){
		if (is_admin() ) {
			require plugin_dir_path(__DIR__) . 'admin/slider-post-how-to.php'; 
		}
	}

}

$slick_slider_post_admin_page = new Slick_Slider_Post_Admin_Page();