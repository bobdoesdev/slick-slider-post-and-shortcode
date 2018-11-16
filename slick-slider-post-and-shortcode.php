<?php 
/**
 * Plugin Name: Slick Slider Post and Shortcodes
 * Description: Adds a custom post type and custom taxonomy for slides, as well as shortcodes for displaying galleries with slick slider.
 * Version: 1.0
 * Author: Bob, O'Brien, Digital Eel Inc.
 * Licence: GPL2
 */

/*  Copyright 2018  Digital Eel Inc.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// exit if file is called directly
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once plugin_dir_path(__FILE__) . 'classes/class-slick-slides-post-type.php';
require_once plugin_dir_path(__FILE__) . 'classes/class-slick-post-rest-slides-controller.php';
require_once plugin_dir_path(__FILE__) . 'classes/class-slick-slider-shortcode.php';
require_once plugin_dir_path(__FILE__) . 'classes/class-slick-slider-post-admin-page.php';



