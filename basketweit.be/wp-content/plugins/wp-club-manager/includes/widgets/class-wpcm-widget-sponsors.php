<?php
/**
 * Sponsors Widget
 *
 * @author 		ClubPress
 * @category 	Widgets
 * @package 	WPClubManager/Widgets
 * @version 	1.3.0
 * @extends 	WPCM_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Sponsors_Widget extends WPCM_Widget {

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass 		= 'wpcm-widget widget-sponsors';
		$this->widget_description 	= __( 'Display a sponsors logo.', 'wp-club-manager' );
		$this->widget_idbase 		= 'wpcm-sponsors-widget';
		$this->widget_name 			= __( 'WPCM Sponsors', 'wp-club-manager' );
		$this->settings           	= array(
			'title'  => array(
				'type'  		=> 'text',
				'std'   		=> __( 'Sponsors', 'wp-club-manager' ),
				'label' 		=> __( 'Title', 'wp-club-manager' )
			),
			'id' => array(
				'type'  		=> 'posts_select',
				'post_type'   	=> 'wpcm_sponsor',
				'std'   		=> 'None',
				'label' 		=> __( 'Choose a sponsor', 'wp-club-manager' ),
				'orderby' 		=> 'post_date',
				'order' 		=> 'DESC',
				'limit' 		=> -1
			),
		);
		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
			
		$this->widget_start( $args, $instance );

		if(isset($instance['id'])):
			$id = $instance['id'];
		endif;

		$link_url = get_post_meta( $id, 'wpcm_link_url', true );
		$link_new_window = get_post_meta( $id, 'wpcm_link_nw', true );

		echo '<div class="wpcm-sponsor-widget clearfix">';

		if ( $link_new_window ) {
			$nw = ' target="_blank"';
		} else {
			$nw = '';
		}

		echo '<a href="'.$link_url.'"'.$nw.'>';
								
		echo get_the_post_thumbnail( $id );

		echo '</a>';

		echo '</div>';

		wp_reset_postdata();

		$this->widget_end( $args );

	}
}