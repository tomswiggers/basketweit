<?php
/**
 * Plugin Name: WP Logo Showcase Responsive Slider
 * Plugin URI: http://www.wponlinesupport.com/
 * Description: Easy to add and display Logo Showcase Responsive Slider on your website. 
 * Author: WP Online Support 
 * Version: 1.2
 * Author URI: http://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author SP Technolab
 */
add_action( 'wp_enqueue_scripts','wplss_logoshowcase_style_css' );
	function wplss_logoshowcase_style_css() {
		wp_enqueue_script( 'logo_showcase_slick_jquery', plugin_dir_url( __FILE__ ) . 'assets/js/slick.min.js', array( 'jquery' ) );		
  		wp_enqueue_style( 'logo_showcase_slick_style',  plugin_dir_url( __FILE__ ) . 'assets/css/slick.css');
  		wp_enqueue_style( 'logo_showcase_style',  plugin_dir_url( __FILE__ ) . 'assets/css/logo-showcase.css');
  		
}
require_once( 'includes/logo-showcase-functions.php' );




