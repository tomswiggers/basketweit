<?php
/**
 * Post types
 *
 * Registers post types.
 *
 * @class 		WPCM_Post_Types
 * @version		1.3.2
 * @package		WPClubManager/Classes/
 * @category	Class
 * @author 		ClubPress
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Post_Types {

	/**
	 * Constructor
	 */
	public function __construct() {
		
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		add_filter('the_posts', array( $this, 'show_future_matches') );
	}

	/**
	 * Register WPClubManager taxonomies.
	 */
	public static function register_taxonomies() {

		if ( taxonomy_exists( 'wpcm_comp' ) )
			return;

		do_action( 'wpclubmanager_register_taxonomy' );

		register_taxonomy( 'wpcm_comp',
			apply_filters( 'wpclubmanager_taxonomy_objects_wpcm_comp', array( 'wpcm_club' ) ),
			apply_filters( 'wpclubmanager_taxonomy_args_wpcm_comp', array(
				'hierarchical' => true,
				'labels' => array (
					'name'               => __( 'Competitions', 'wp-club-manager' ),
					'singular_name'      => __( 'Competition', 'wp-club-manager' ),
					'search_items'       => __( 'Search Competitions', 'wp-club-manager' ),
					'all_items'          => __( 'All Competitions', 'wp-club-manager' ),
					'parent_item'        => __( 'Parent Competition', 'wp-club-manager' ),
					'parent_item_colon'  => __( 'Parent Competition:', 'wp-club-manager' ),
					'edit_item'          => __( 'Edit Competition', 'wp-club-manager' ),
					'update_item'        => __( 'Update Competition', 'wp-club-manager' ),
					'add_new_item'       => __( 'Add New Competition', 'wp-club-manager' ),
					'new_item_name'      => __( 'Competition', 'wp-club-manager' )
				),
				'show_in_nav_menus' => false,
				'sort' => true,
				'rewrite' => array( 'slug' => 'competitions' )
			) )
		);

		register_taxonomy( 'wpcm_jobs',
			apply_filters( 'wpclubmanager_taxonomy_objects_wpcm_jobs', array( 'wpcm_staff' ) ),
			apply_filters( 'wpclubmanager_taxonomy_args_wpcm_jobs', array(
				'hierarchical' => true,
				'labels' => array(
					'name'               => __( 'Jobs', 'wp-club-manager' ),
					'singular_name'      => __( 'Job', 'wp-club-manager' ),
					'search_items'       => __( 'Search Jobs', 'wp-club-manager' ),
					'all_items'          => __( 'All Jobs', 'wp-club-manager' ),
					'parent_item'        => __( 'Parent Job', 'wp-club-manager' ),
					'parent_item_colon'  => __( 'Parent Job:', 'wp-club-manager' ),
					'edit_item'          => __( 'Edit Job', 'wp-club-manager' ),
					'update_item'        => __( 'Update Job', 'wp-club-manager' ),
					'add_new_item'       => __( 'Add New Job', 'wp-club-manager' ),
					'new_item_name'      => __( 'New Job Title', 'wp-club-manager' )
				),
				'show_in_nav_menus' => false,
				'sort' => true,
				'rewrite' => array( 'slug' => 'jobs' )
			) )
		);

		register_taxonomy( 'wpcm_position',
			apply_filters( 'wpclubmanager_taxonomy_objects_wpcm_position', array( 'wpcm_player' ) ),
			apply_filters( 'wpclubmanager_taxonomy_args_wpcm_position', array(
				'hierarchical' => true,
				'labels' => array(
					'name'               => __( 'Positions', 'wp-club-manager' ),
					'singular_name'      => __( 'Position', 'wp-club-manager' ),
					'search_items'       => __( 'Search Positions', 'wp-club-manager' ),
					'all_items'          => __( 'All Positions', 'wp-club-manager' ),
					'parent_item'        => __( 'Parent Position', 'wp-club-manager' ),
					'parent_item_colon'  => __( 'Parent Position:', 'wp-club-manager' ),
					'edit_item'          => __( 'Edit Position', 'wp-club-manager' ),
					'update_item'        => __( 'Update Position', 'wp-club-manager' ),
					'add_new_item'       => __( 'Add New Position', 'wp-club-manager' ),
					'new_item_name'      => __( 'New Position Name', 'wp-club-manager' )
				),
				'show_in_nav_menus' => false,
				'sort' => true,
				'rewrite' => array( 'slug' => 'positions' )
			) )
		);

		register_taxonomy( 'wpcm_season',
			apply_filters( 'wpclubmanager_taxonomy_objects_wpcm_season', array('wpcm_club','wpcm_player','wpcm_staff' ) ),
			apply_filters( 'wpclubmanager_taxonomy_args_wpcm_season', array(
				'hierarchical' => true,
				'labels' => array(
					'name'               => __( 'Seasons', 'wp-club-manager' ),
					'singular_name'      => __( 'Season', 'wp-club-manager' ),
					'search_items'       => __( 'Search Seasons', 'wp-club-manager' ),
					'all_items'          => __( 'All Seasons', 'wp-club-manager' ),
					'parent_item'        => __( 'Parent Season', 'wp-club-manager' ),
					'parent_item_colon'  => __( 'Parent Season:', 'wp-club-manager' ),
					'edit_item'          => __( 'Edit Season', 'wp-club-manager' ),
					'update_item'        => __( 'Update Season', 'wp-club-manager' ),
					'add_new_item'       => __( 'Add New Season', 'wp-club-manager' ),
					'new_item_name'      => __( 'Season', 'wp-club-manager' )
				),
				'show_in_nav_menus' => false,
				'sort' => true,
				'rewrite' => array( 'slug' => 'seasons' )
			) )
		);

		register_taxonomy( 'wpcm_team',
			apply_filters( 'wpclubmanager_taxonomy_objects_wpcm_team', array('wpcm_player','wpcm_staff') ),
			apply_filters( 'wpclubmanager_taxonomy_args_wpcm_team', array(
				'hierarchical' =>true,
				'labels' => array(
					'name'               => __( 'Teams', 'wp-club-manager' ),
					'singular_name'      => __( 'Team', 'wp-club-manager' ),
					'search_items'       =>  __( 'Search Teams', 'wp-club-manager' ),
					'all_items'          => __( 'All Teams', 'wp-club-manager' ),
					'parent_item'        => __( 'Parent Team', 'wp-club-manager' ),
					'parent_item_colon'  => __( 'Parent Team:', 'wp-club-manager' ),
					'edit_item'          => __( 'Edit Team', 'wp-club-manager' ),
					'update_item'        => __( 'Update Team', 'wp-club-manager' ),
					'add_new_item'       => __( 'Add New Team', 'wp-club-manager' ),
					'new_item_name'      => __( 'Team', 'wp-club-manager' )
				),
				'show_in_nav_menus' => false,
				'sort' => true,
				'rewrite' => array( 'slug' => 'teams' )
			) )
		);

		register_taxonomy( 'wpcm_venue',
			apply_filters( 'wpclubmanager_taxonomy_objects_wpcm_venue', array( 'wpcm_club' ) ),
			apply_filters( 'wpclubmanager_taxonomy_args_wpcm_venue', array(
				'hierarchical' => true,
				'labels' => array(
					'name'               => __( 'Venues', 'wp-club-manager' ),
					'singular_name'      => __( 'Venue', 'wp-club-manager' ),
					'search_items'       =>  __( 'Search Venues', 'wp-club-manager' ),
					'all_items'          => __( 'All Venues', 'wp-club-manager' ),
					'parent_item'        => __( 'Parent Venue', 'wp-club-manager' ),
					'parent_item_colon'  => __( 'Parent Venue:', 'wp-club-manager' ),
					'edit_item'          => __( 'Edit Venue', 'wp-club-manager' ),
					'update_item'        => __( 'Update Venue', 'wp-club-manager' ),
					'add_new_item'       => __( 'Add New Venue', 'wp-club-manager' ),
					'new_item_name'      => __( 'Venue', 'wp-club-manager' )
				),
				'show_in_nav_menus' => false,
				'sort' => true,
				'rewrite' => array( 'slug' => 'venues' )
			) )
		);

	}

	/**
	 * Register core post types
	 */
	public static function register_post_types() {

		if ( post_type_exists('wpcm_player') )
			return;

		do_action( 'wpclubmanager_register_post_type' );

		register_post_type( 'wpcm_club',
			apply_filters( 'wpclubmanager_register_post_type_club',
				array(
					'labels' => array(
						'name'                => __( 'Clubs', 'wp-club-manager' ),
						'singular_name'       => __( 'Club', 'wp-club-manager' ),
						'add_new'             => __( 'Add New', 'wp-club-manager' ),
						'all_items'           => __( 'All Clubs', 'wp-club-manager' ),
						'add_new_item'        => __( 'Add New Club', 'wp-club-manager' ),
						'edit_item'           => __( 'Edit Club', 'wp-club-manager' ),
						'new_item'            => __( 'New Club', 'wp-club-manager' ),
						'view_item'           => __( 'View Club', 'wp-club-manager' ),
						'search_items'        => __( 'Search Clubs', 'wp-club-manager' ),
						'not_found'           => __( 'No clubs found', 'wp-club-manager' ),
						'not_found_in_trash'  => __( 'No clubs found in trash'),
						'parent_item_colon'   => __( 'Parent Club:', 'wp-club-manager' ),
						'menu_name'           => __( 'Clubs', 'wp-club-manager' )
					),
					'hierarchical'         => false,
					'supports'             => array( 'title', 'editor', 'thumbnail' ),
					'public'               => true,
					'show_ui'              => true,
					'show_in_menu'         => true,
					'show_in_nav_menus'    => false,
					'menu_icon'            => 'dashicons-shield',
					'publicly_queryable'   => true,
					'exclude_from_search'  => true,
					'has_archive'          => false,
					'query_var'            => true,
					'can_export'           => true,
					'rewrite'              => array( 'slug' => get_option( 'wpclubmanager_club_slug', 'club' ) ),
					'capability_type'      => 'post'
				)
			)
		);
		
		register_post_type( 'wpcm_player',
			apply_filters( 'wpclubmanager_register_post_type_player',
				array(
					'labels' => array(
						'name'                => __( 'Players', 'wp-club-manager' ),
						'singular_name'       => __( 'Player', 'wp-club-manager' ),
						'add_new'             => __( 'Add New', 'wp-club-manager' ),
						'all_items'           => __( 'All Players', 'wp-club-manager' ),
						'add_new_item'        => __( 'Add New Player', 'wp-club-manager' ),
						'edit_item'           => __( 'Edit Player', 'wp-club-manager' ),
						'new_item'            => __( 'New Player', 'wp-club-manager' ),
						'view_item'           => __( 'View Player', 'wp-club-manager' ),
						'search_items'        => __( 'Search Players', 'wp-club-manager' ),
						'not_found'           => __( 'No players found', 'wp-club-manager' ),
						'not_found_in_trash'  => __( 'No players found in trash'),
						'parent_item_colon'   => __( 'Parent Player:', 'wp-club-manager' ),
						'menu_name'           => __( 'Players', 'wp-club-manager' )
					),
					'hierarchical'         => false,
					'supports'             => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
					'public'               => true,
					'show_ui'              => true,
					'show_in_menu'         => true,
					'show_in_nav_menus'    => true,
					'menu_icon'            => 'dashicons-groups',
					'publicly_queryable'   => true,
					'exclude_from_search'  => false,
					'has_archive'          => false,
					'query_var'            => true,
					'can_export'           => true,
					'rewrite'              => array( 'slug' => get_option( 'wpclubmanager_player_slug', 'player' ) ),
					'capability_type'      => 'post'
				)
			)
		);

		register_post_type( 'wpcm_staff',
			apply_filters( 'wpclubmanager_register_post_type_staff',
				array(
					'labels' => array(
						'name'                => __( 'Staff', 'wp-club-manager' ),
						'singular_name'       => __( 'Staff', 'wp-club-manager' ),
						'add_new'             => __( 'Add New', 'wp-club-manager' ),
						'all_items'           => __( 'All Staff', 'wp-club-manager' ),
						'add_new_item'        => __( 'Add New Staff', 'wp-club-manager' ),
						'edit_item'           => __( 'Edit Staff', 'wp-club-manager' ),
						'new_item'            => __( 'New Staff', 'wp-club-manager' ),
						'view_item'           => __( 'View Staff', 'wp-club-manager' ),
						'search_items'        => __( 'Search Staff', 'wp-club-manager' ),
						'not_found'           => __( 'No staff found', 'wp-club-manager' ),
						'not_found_in_trash'  => __( 'No staff found in trash'),
						'parent_item_colon'   => __( 'Parent Staff:', 'wp-club-manager' ),
						'menu_name'           => __( 'Staff', 'wp-club-manager' )
					),
					'hierarchical'         => false,
					'supports'             => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
					'public'               => true,
					'show_ui'              => true,
					'show_in_menu'         => true,
					'show_in_nav_menus'    => false,
					'menu_icon'            => 'dashicons-businessman',
					'publicly_queryable'   => true,
					'exclude_from_search'  => true,
					'has_archive'          => false,
					'query_var'            => true,
					'can_export'           => true,
					'rewrite'              => array( 'slug' => get_option( 'wpclubmanager_staff_slug', 'staff' ) ),
					'capability_type'      => 'post'
				)
			)
		);

		register_post_type( 'wpcm_match',
			apply_filters( 'wpclubmanager_register_post_type_match',
				array(
					'labels' => array(
						'name'                => __( 'Matches', 'wp-club-manager' ),
						'singular_name'       => __( 'Match', 'wp-club-manager' ),
						'add_new'             => __( 'Add New', 'wp-club-manager' ),
						'all_items'           => __( 'All Matches', 'wp-club-manager' ),
						'add_new_item'        => __( 'Add New Match', 'wp-club-manager' ),
						'edit_item'           => __( 'Edit Match', 'wp-club-manager' ),
						'new_item'            => __( 'New Match', 'wp-club-manager' ),
						'view_item'           => __( 'View Match', 'wp-club-manager' ),
						'search_items'        => __( 'Search Matches', 'wp-club-manager' ),
						'not_found'           => __( 'No matches found', 'wp-club-manager' ),
						'not_found_in_trash'  => __( 'No matches found in trash'),
						'parent_item_colon'   => __( 'Parent Match:', 'wp-club-manager' ),
						'menu_name'           => __( 'Matches', 'wp-club-manager' )
					),
					'hierarchical'         => false,
					'supports'             => array( 'editor', 'excerpt' ),
					'public'               => true,
					'show_ui'              => true,
					'show_in_menu'         => true,
					'show_in_nav_menus'    => true,
					'menu_icon'            => 'dashicons-awards',
					'publicly_queryable'   => true,
					'exclude_from_search'  => false,
					'has_archive'          => false,
					'query_var'            => true,
					'can_export'           => true,
					'rewrite'              => array( 'slug' => get_option( 'wpclubmanager_match_slug', 'match' ) ),
					'capability_type'      => 'post'
				)
			)
		);

		register_post_type( 'wpcm_sponsor',
			apply_filters( 'wpclubmanager_register_post_type_sponsor',
				array(
					'labels' => array(
						'name'                => __( 'Sponsors', 'wp-club-manager' ),
						'singular_name'       => __( 'Sponsor', 'wp-club-manager' ),
						'add_new'             => __( 'Add New Sponsor', 'wp-club-manager' ),
						'all_items'           => __( 'All Sponsors', 'wp-club-manager' ),
						'add_new_item'        => __( 'Add New Sponsor', 'wp-club-manager' ),
						'edit_item'           => __( 'Edit Sponsor', 'wp-club-manager' ),
						'new_item'            => __( 'New Sponsor', 'wp-club-manager' ),
						'view_item'           => __( 'View Sponsor', 'wp-club-manager' ),
						'search_items'        => __( 'Search Sponsors', 'wp-club-manager' ),
						'not_found'           => __( 'No sponsors found', 'wp-club-manager' ),
						'not_found_in_trash'  => __( 'No sponsors found in trash'),
						'parent_item_colon'   => __( 'Parent Sponsor:', 'wp-club-manager' ),
						'menu_name'           => __( 'Sponsors', 'wp-club-manager' )
					),
					'hierarchical'         => false,
					'supports'             => array( 'title', 'thumbnail' ),
					'public'               => true,
					'show_ui'              => true,
					'show_in_menu'         => true,
					'show_in_nav_menus'    => false,
					'menu_icon'            => 'dashicons-megaphone',
					'publicly_queryable'   => true,
					'exclude_from_search'  => true,
					'has_archive'          => false,
					'query_var'            => true,
					'can_export'           => true,
					'rewrite'              => array( 'with_front' => false, 'slug' => 'sponsors' ),
					'capability_type'      => 'post'
				)
			)
		);
	}

	/**
	 * Show future matches
	 *
	 * @access public
	 * @param string $posts
	 * @return string
	 */
	public function show_future_matches($posts) {
		global $wp_query, $wpdb;
		if(is_single() && $wp_query->post_count == 0  && isset( $wp_query->query_vars['wpcm_match'] )) {
			$posts = $wpdb->get_results($wp_query->request);
		}
		return $posts;
	}
}

new WPCM_Post_Types();