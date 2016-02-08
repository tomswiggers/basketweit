<?php
/**
 * WPClubManager Matches Settings
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WPCM_Settings_Matches' ) ) :

class WPCM_Settings_Matches extends WPCM_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id    = 'matches';
		$this->label = __( 'Matches', 'wp-club-manager' );

		add_filter( 'wpclubmanager_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
		add_action( 'wpclubmanager_settings_' . $this->id, array( $this, 'output' ) );
		add_action( 'wpclubmanager_settings_save_' . $this->id, array( $this, 'save' ) );
	}

	/**
	 * Get settings array
	 *
	 * @return array
	 */
	public function get_settings() {
		
		return apply_filters( 'wpclubmanager_matches_settings', array(

			array( 'title' => __( 'Title Format Options', 'wp-club-manager' ), 'type' => 'title', 'desc' => '', 'id' => 'match_format_options' ),

			array(
				'title' 	=> __( 'Choose the format to display matches', 'wp-club-manager' ),
				'desc' 		=> '',
				'id' 		=> 'wpcm_match_title_format',
				'default'	=> '%home% vs %away%',
				'type' 		=> 'radio',
				'options' => array(
					'%home% vs %away%'  => __( 'Default - <code>%home% v %away%</code>', 'wp-club-manager' ),
					'%away% vs %home%'	=> __( 'Reverse - <code>%away% v %home%</code>', 'wp-club-manager' ),
				),
				'desc_tip'	=>  false
			),

			array( 'type' => 'sectionend', 'id' => 'match_format_options'),

			array(	'title' => __( 'Display Options', 'wp-club-manager' ), 'type' => 'title', 'desc' => '', 'id' => 'match_delimiter_options' ),

			array(
				'title' 	=> __( 'Clubs Separator', 'wp-club-manager' ),
				'desc' 		=> __( 'This sets the separator of clubs.', 'wp-club-manager' ),
				'id' 		=> 'wpcm_match_clubs_separator',
				'css' 		=> 'width:50px;',
				'default'	=> 'v',
				'type' 		=> 'text',
				'desc_tip'	=>  true,
			),

			array(
				'title' 	=> __( 'Goals Delimiter', 'wp-club-manager' ),
				'desc' 		=> __( 'This sets the separator of results.', 'wp-club-manager' ),
				'id' 		=> 'wpcm_match_goals_delimiter',
				'css' 		=> 'width:50px;',
				'default'	=> '-',
				'type' 		=> 'text',
				'desc_tip'	=>  true,
			),

			array( 'type' => 'sectionend', 'id' => 'match_delimiter_options' ),

			array( 'title' 	=> __( 'Pre Match Display Options', 'wp-club-manager' ), 'type' => 'title', 'desc' => '','id' 	=> 'match_fixture_display_options' ),

			array(
				'title' 	=> __( 'Team', 'wp-club-manager' ),
				'desc' 		=> '',
				'id' 		=> 'wpcm_fixtures_show_team',
				'default'	=> 'yes',
				'type' 		=> 'checkbox'
			),

			array(
				'title' 	=> __( 'Referee', 'wp-club-manager' ),
				'desc' 		=> '',
				'id' 		=> 'wpcm_fixtures_show_referee',
				'default'	=> 'no',
				'type' 		=> 'checkbox'
			),

			array( 'type' 	=> 'sectionend', 'id' => 'match_fixture_display_options'),

			array( 'title' 	=> __( 'Post Match Display Options', 'wp-club-manager' ), 'type' => 'title', 'desc' => '', 'id' 	   => 'match_result_display_options' ),

			array(
				'title' 	=> __( 'Team', 'wp-club-manager' ),
				'desc' 		=> '',
				'id' 		=> 'wpcm_results_show_team',
				'default'	=> 'yes',
				'type' 		=> 'checkbox'
			),

			array(
				'title' 	=> __( 'Attendance', 'wp-club-manager' ),
				'desc' 		=> '',
				'id' 		=> 'wpcm_results_show_attendance',
				'default'	=> 'yes',
				'type' 		=> 'checkbox'
			),

			array(
				'title' 	=> __( 'Referee', 'wp-club-manager' ),
				'desc' 		=> '',
				'id' 		=> 'wpcm_results_show_referee',
				'default'	=> 'yes',
				'type' 		=> 'checkbox'
			),

			array(
				'title' 	=> __( 'Show Player Thumbnails', 'wp-club-manager' ),
				'desc' 		=> '',
				'id' 		=> 'wpcm_results_show_image',
				'default'	=> 'no',
				'type' 		=> 'checkbox'
			),

			array( 'type' => 'sectionend', 'id' => 'match_result_display_options'),

		)); // End matches settings
	}

	/**
	 * Save settings
	 */
	public function save() {
		$settings = $this->get_settings();

		WPCM_Admin_Settings::save_fields( $settings );
	}

}

endif;

return new WPCM_Settings_Matches();