<?php
/**
 * Installation related functions and actions.
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Classes
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Install {

	/**
	 * Hook in tabs.
	 */
	public static function init() {

		add_action( 'admin_init', array( __CLASS__, 'check_version' ), 5 );
		add_action( 'admin_init', array( __CLASS__, 'install_actions' ) );
		add_action( 'in_plugin_update_message-wp-club-manager/wpclubmanager.php', array( __CLASS__, 'in_plugin_update_message' ) );
		add_filter( 'plugin_action_links_' . WPCM_PLUGIN_BASENAME, array( __CLASS__, 'plugin_action_links' ) );
		add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_row_meta' ), 10, 2 );
	}

	/**
	 * check_version function.
	 *
	 * @access public
	 * @return void
	 */
	public static function check_version() {

		if ( ! defined( 'IFRAME_REQUEST' ) && ( get_option( 'wpclubmanager_version' ) != WPCM()->version ) ) {
			self::install();

			do_action( 'wpclubmanager_updated' );
		}
	}

	/**
	 * Install actions such as installing pages when a button is clicked.
	 */
	public static function install_actions() {
		
		if ( ! empty( $_GET['do_update_wpclubmanager'] ) ) {

			self::update();

			// Update complete
			WPCM_Admin_Notices::remove_notice( 'update' );

			// What's new redirect
			delete_transient( '_wpcm_activation_redirect' );
			wp_redirect( admin_url( 'index.php?page=wpcm-about&wpcm-updated=true' ) );
			exit;
		}
	}

	/**
	 * Install WPCM
	 */
	public static function install() {

		if ( ! defined( 'WPCM_INSTALLING' ) ) {
			define( 'WPCM_INSTALLING', true );
		}

		// Ensure needed classes are loaded
		include_once( 'admin/class-wpcm-admin-notices.php' );

		self::create_options();
		self::create_roles();

		// Register post types
		WPCM_Post_Types::register_post_types();
		WPCM_Post_Types::register_taxonomies();

		// Queue upgrades
		$current_version = get_option( 'wpclubmanager_version', null );
		if ( $current_version ) {
			update_option( 'wpcm_version_upgraded_from', $current_version );
		}
		
		// Update version
		delete_option( 'wpclubmanager_version' );
		add_option( 'wpclubmanager_version', WPCM()->version );

		// Flush rules after install
		flush_rewrite_rules();

		// Redirect to welcome screen
		if ( ! is_network_admin() && ! isset( $_GET['activate-multi'] ) ) {
			set_transient( '_wpcm_activation_redirect', 1, 30 );
		}

		// Trigger action
		do_action( 'wpclubmanager_installed' );

	}

	/**
	 * Handle updates
	 */
	private static function update() {
		// Do updates
		$current_version = get_option( 'wpclubmanager_version' );

		if ( version_compare( $current_version, '1.1.0', '<' ) ) {
			include( 'updates/wpclubmanager-update-1.1.0.php' );
			update_option( 'wpclubmanager_version', '1.1.0' );
		}
	}

	/**
	 * Default options
	 *
	 * Sets up the default options used on the settings page
	 *
	 * @access public
	 */
	private static function create_options() {
		// Include settings so that we can run through defaults
		include_once( 'admin/class-wpcm-admin-settings.php' );

		$settings = WPCM_Admin_Settings::get_settings_pages();

		foreach ( $settings as $section ) {
			foreach ( $section->get_settings() as $value ) {
				if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
					$autoload = isset( $value['autoload'] ) ? (bool) $value['autoload'] : true;
					add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
				}
			}
		}

		if ( ! get_option( 'wpclubmanager_installed' ) ) {
			// Configure default sport
			$sport = 'soccer';
			$options = wpcm_get_sport_presets();
			WPCM_Admin_Settings::configure_sport( $options[ $sport ] );
			update_option( 'wpcm_sport', $sport );
			update_option( 'wpclubmanager_installed', 1 );
		}
	}

	/**
	 * Create roles and capabilities
	 */
	public static function create_roles() {
		global $wp_roles;

		if ( class_exists( 'WP_Roles' ) ) {
			if ( ! isset( $wp_roles ) ) {
				$wp_roles = new WP_Roles();
			}
		}

		if ( is_object( $wp_roles ) ) {

			// Player role
			add_role( 'player', __( 'Player', 'wp-club-manager' ), array(
				'level_1' 						=> true,
				'level_0' 						=> true,

	            'read' 							=> true,
	            'delete_posts' 					=> true,
	            'edit_posts' 					=> true,
	            'upload_files' 					=> true,

	            'edit_wpcm_player'				=> true,
	            'read_wpcm_player'				=> true,
	            'edit_wpcm_players' 			=> true,
	            'edit_published_wpcm_players' 	=> true,
				'assign_wpcm_player_terms' 		=> true,
			) );

			add_role( 'staff', __( 'Staff', 'wp-club-manager' ), array(
				'level_1' 						=> true,
				'level_0' 						=> true,

	            'read' 							=> true,
	            'delete_posts' 					=> true,
	            'edit_posts' 					=> true,
	            'upload_files' 					=> true,

	            'edit_wpcm_staff'				=> true,
	            'read_wpcm_staff'				=> true,
	            'edit_wpcm_staff' 				=> true,
	            'edit_published_wpcm_staff' 	=> true,
				'assign_wpcm_staff_terms' 		=> true,

	            'edit_wpcm_player'				=> true,
	            'read_wpcm_player'				=> true,
	            'delete_wpcm_player'			=> true,
	            'edit_wpcm_playeres' 			=> true,
	            'publish_wpcm_players' 			=> true,
	            'delete_wpcm_players' 			=> true,
	            'delete_published_wpcm_players' => true,
	            'edit_published_wpcm_players' 	=> true,
				'assign_wpcm_player_terms' 		=> true,

				'edit_wpcm_club'				=> true,
	            'read_wpcm_club'				=> true,
	            'delete_wpcm_club'				=> true,
	            'edit_wpcm_clubes' 				=> true,
	            'publish_wpcm_clubs' 			=> true,
	            'delete_wpcm_clubs' 			=> true,
	            'delete_published_wpcm_clubs' 	=> true,
	            'edit_published_wpcm_clubs' 	=> true,
				'assign_wpcm_club_terms' 		=> true,

				'edit_wpcm_match'				=> true,
	            'read_wpcm_match'				=> true,
	            'delete_wpcm_match'				=> true,
	            'edit_wpcm_matchs' 				=> true,
	            'publish_wpcm_matchs' 			=> true,
	            'delete_wpcm_matchs' 			=> true,
	            'delete_published_wpcm_matchs' 	=> true,
	            'edit_published_wpcm_matchs' 	=> true,
				'assign_wpcm_match_terms' 		=> true,

				'edit_wpcm_sponsor'				=> true,
	            'read_wpcm_sponsor'				=> true,
	            'delete_wpcm_sponsor'			=> true,
	            'edit_wpcm_sponsors' 			=> true,
	            'publish_wpcm_sponsors' 		=> true,
	            'delete_wpcm_sponsors' 			=> true,
	            'delete_published_wpcm_sponsors'=> true,
	            'edit_published_wpcm_sponsors' 	=> true,
				'assign_wpcm_sponsor_terms' 	=> true,
		        )
		    );

			// Manager role
			add_role( 'team_manager', __( 'Team Manager', 'wp-club-manager' ), array(
				'level_2' 						=> true,
				'level_1' 						=> true,
				'level_0' 						=> true,

	            'read' 							=> true,
	            'delete_posts' 					=> true,
	            'edit_posts' 					=> true,
	            'delete_published_posts' 		=> true,
	            'publish_posts' 				=> true,
	            'upload_files' 					=> true,
	            'edit_published_posts' 			=> true,

	            'edit_wpcm_player'				=> true,
	            'read_wpcm_player'				=> true,
	            'delete_wpcm_player'			=> true,
	            'edit_wpcm_players' 			=> true,
	            'publish_wpcm_players' 			=> true,
	            'delete_wpcm_players' 			=> true,
	            'delete_published_wpcm_players' => true,
	            'edit_published_wpcm_players' 	=> true,
				'assign_wpcm_player_terms' 		=> true,

	            'edit_wpcm_staff'				=> true,
	            'read_wpcm_staff'				=> true,
	            'delete_wpcm_staff'				=> true,
	            'edit_wpcm_staffs' 				=> true,
	            'publish_wpcm_staffs' 			=> true,
	            'delete_wpcm_staffs' 			=> true,
	            'delete_published_wpcm_staffs' 	=> true,
	            'edit_published_wpcm_staffs' 	=> true,
				'assign_wpcm_staff_terms' 		=> true,

				'edit_wpcm_match'				=> true,
	            'read_wpcm_match'				=> true,
	            'delete_wpcm_match'				=> true,
	            'edit_wpcm_matchs' 				=> true,
	            'publish_wpcm_matchs' 			=> true,
	            'delete_wpcm_matchs' 			=> true,
	            'delete_published_wpcm_matchs' 	=> true,
	            'edit_published_wpcm_matchs' 	=> true,
				'assign_wpcm_match_terms' 		=> true,
			) );

			$capabilities = self::get_core_capabilities();

			foreach ( $capabilities as $cap_group ) {
				foreach ( $cap_group as $cap ) {
					$wp_roles->add_cap( 'player', $cap );
					$wp_roles->add_cap( 'staff', $cap );
					$wp_roles->add_cap( 'team_manager', $cap );
					$wp_roles->add_cap( 'administrator', $cap );
				}
			}
		}
	}

	/**
	 * Get capabilities for WP Club Manager - these are assigned to admin/shop manager during installation or reset
	 *
	 * @access public
	 * @return array
	 */
	private static function get_core_capabilities() {
		$capabilities = array();

		$capabilities['core'] = array(
			'manage_wpclubmanager'
		);

		$capability_types = array( 'wpcm_club', 'wpcm_player', 'wpcm_sponsor', 'wpcm_staff', 'wpcm_match' );

		foreach ( $capability_types as $capability_type ) {

			$capabilities[ $capability_type ] = array(
				// Post type
				"edit_{$capability_type}",
				"read_{$capability_type}",
				"delete_{$capability_type}",
				"edit_{$capability_type}s",
				"edit_others_{$capability_type}s",
				"publish_{$capability_type}s",
				"read_private_{$capability_type}s",
				"delete_{$capability_type}s",
				"delete_private_{$capability_type}s",
				"delete_published_{$capability_type}s",
				"delete_others_{$capability_type}s",
				"edit_private_{$capability_type}s",
				"edit_published_{$capability_type}s",

				// Terms
				"manage_{$capability_type}_terms",
				"edit_{$capability_type}_terms",
				"delete_{$capability_type}_terms",
				"assign_{$capability_type}_terms"
			);
		}

		return $capabilities;
	}

	/**
	 * wpclubmanager_remove_roles function.
	 *
	 * @access public
	 * @return void
	 */
	public static function remove_roles() {
		global $wp_roles;

		if ( class_exists( 'WP_Roles' ) ) {
			if ( ! isset( $wp_roles ) ) {
				$wp_roles = new WP_Roles();
			}
		}

		if ( is_object( $wp_roles ) ) {

			$capabilities = self::get_core_capabilities();

			foreach ( $capabilities as $cap_group ) {
				foreach ( $cap_group as $cap ) {
					$wp_roles->remove_cap( 'player', $cap );
					$wp_roles->remove_cap( 'staff', $cap );
					$wp_roles->remove_cap( 'team_manager', $cap );
					$wp_roles->remove_cap( 'administrator', $cap );
				}
			}

			remove_role( 'player' );
			remove_role( 'staff' );
			remove_role( 'team_manager' );
		}
	}

	/**
	 * Show plugin changes. Code adapted from W3 Total Cache.
	 */
	public static function in_plugin_update_message( $args ) {
		$transient_name = 'wpcm_upgrade_notice_' . $args['Version'];

		if ( false === ( $upgrade_notice = get_transient( $transient_name ) ) ) {
			$response = wp_safe_remote_get( 'https://plugins.svn.wordpress.org/wp-club-manager/trunk/readme.txt' );

			if ( ! is_wp_error( $response ) && ! empty( $response['body'] ) ) {
				$upgrade_notice = self::parse_update_notice( $response['body'] );
				set_transient( $transient_name, $upgrade_notice, DAY_IN_SECONDS );
			}
		}

		echo wp_kses_post( $upgrade_notice );
	}

	/**
	 * Parse update notice from readme file
	 * @param  string $content
	 * @return string
	 */
	private static function parse_update_notice( $content ) {
		// Output Upgrade Notice
		$matches        = null;
		$regexp         = '~==\s*Upgrade Notice\s*==\s*=\s*(.*)\s*=(.*)(=\s*' . preg_quote( WPCM_VERSION ) . '\s*=|$)~Uis';
		$upgrade_notice = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$version = trim( $matches[1] );
			$notices = (array) preg_split('~[\r\n]+~', trim( $matches[2] ) );

			if ( version_compare( WPCM_VERSION, $version, '<' ) ) {

				$upgrade_notice .= '<div class="wpcm_plugin_upgrade_notice">';

				foreach ( $notices as $index => $line ) {
					$upgrade_notice .= wp_kses_post( preg_replace( '~\[([^\]]*)\]\(([^\)]*)\)~', '<a href="${2}">${1}</a>', $line ) );
				}

				$upgrade_notice .= '</div> ';
			}
		}

		return wp_kses_post( $upgrade_notice );
	}

	/**
	 * Show action links on the plugin screen.
	 *
	 * @param	mixed $links Plugin Action links
	 * @return	array
	 */
	public static function plugin_action_links( $links ) {
		$action_links = array(
			'settings' => '<a href="' . admin_url( 'admin.php?page=wpcm-settings' ) . '" title="' . esc_attr( __( 'View WP Club Manager Settings', 'wp-club-manager' ) ) . '">' . __( 'Settings', 'wp-club-manager' ) . '</a>'
		);

		return array_merge( $action_links, $links );
	}

	/**
	 * Show row meta on the plugin screen.
	 *
	 * @param	mixed $links Plugin Row Meta
	 * @param	mixed $file  Plugin Base file
	 * @return	array
	 */
	public static function plugin_row_meta( $links, $file ) {
		if ( $file == WPCM_PLUGIN_BASENAME ) {
			$row_meta = array(
				'docs'    => '<a href="' . esc_url( apply_filters( 'wpclubmanager_docs_url', 'http://wpclubmanager.com/docs/', 'wp-club-manager' ) ) . '" title="' . esc_attr( __( 'View WP Club Manager Documentation', 'wp-club-manager' ) ) . '">' . __( 'Docs', 'wp-club-manager' ) . '</a>',
				'support' => '<a href="' . esc_url( apply_filters( 'wpclubmanager_support_url', 'http://wpclubmanager.com/support/' ) ) . '" title="' . esc_attr( __( 'Visit Support Forum', 'wp-club-manager' ) ) . '">' . __( 'Support', 'wp-club-manager' ) . '</a>',
			);

			return array_merge( $links, $row_meta );
		}

		return (array) $links;
	}
}

return new WPCM_Install();