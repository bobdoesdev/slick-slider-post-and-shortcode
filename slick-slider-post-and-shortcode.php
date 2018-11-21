<?php 
/**
 * Plugin Name: Slick Slider Post and Shortcodes
 * Description: Adds a custom post type and custom taxonomy for slides, as well as shortcodes for displaying galleries with slick slider.
 * Version: 1.0
 * Author: Bob, O'Brien, Digital Eel Inc.
 * Licence: GPL2
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once plugin_dir_path(__FILE__) . 'classes/class-slick-slides-post-type.php';
require_once plugin_dir_path(__FILE__) . 'classes/class-slick-post-rest-slides-controller.php';
require_once plugin_dir_path(__FILE__) . 'classes/class-slick-slider-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'classes/class-slick-slider-post-admin-page.php';



