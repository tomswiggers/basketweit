<?php
/**
 * Display notices in admin.
 *
 * @author 		Clubpress
 * @category 	Admin
 * @package 	WPClubManager/Admin
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WPCM_Admin_Notices Class
 */
class WPCM_Admin_Notices {

	/**
	 * Array of notices - name => callback
	 * @var array
	 */
	private $notices = array(
		'update'              => 'update_notice',
		'template_files'      => 'template_file_check_notice',
		'theme_support'       => 'theme_check_notice'
	);

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'switch_theme', array( $this, 'reset_admin_notices' ) );
		add_action( 'wpclubmanager_installed', array( $this, 'reset_admin_notices' ) );
		add_action( 'wpclubmanager_updated', array( $this, 'reset_admin_notices' ) );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ) );
		add_action( 'admin_print_styles', array( $this, 'add_notices' ) );
	}

	/**
	 * Reset notices for themes when switched or a new version of WPCM is installed
	 */
	public function reset_admin_notices() {

		if ( ! current_theme_supports( 'wpclubmanager' ) && ! in_array( get_option( 'template' ), wpcm_get_core_supported_themes() ) ) {
			self::add_notice( 'theme_support' );
		}

		self::add_notice( 'template_files' );
	}

	/**
	 * Add notices + styles if needed.
	 */
	public static function add_notice( $name ) {

		$notices = array_unique( array_merge( get_option( 'wpclubmanager_admin_notices', array() ), array( $name ) ) );
		update_option( 'wpclubmanager_admin_notices', $notices );

	}

	/**
	 * Remove a notice from being displayed
	 * @param  string $name
	 */
	public static function remove_notice( $name ) {
		$notices = array_diff( get_option( 'wpclubmanager_admin_notices', array() ), array( $name ) );
		update_option( 'wpclubmanager_admin_notices', $notices );
	}

	/**
	 * See if a notice is being shown
	 * @param  string  $name
	 * @return boolean
	 */
	public static function has_notice( $name ) {
		return in_array( $name, get_option( 'wpclubmanager_admin_notices', array() ) );
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public function hide_notices() {
		if ( isset( $_GET['wpcm-hide-notice'] ) && isset( $_GET['_wpcm_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_wpcm_notice_nonce'], 'wpclubmanager_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'wp-club-manager' ) );
			}

			if ( ! current_user_can( 'manage_wpclubmanager' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'wp-club-manager' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['wpcm-hide-notice'] );
			self::remove_notice( $hide_notice );
			do_action( 'wpclubmanager_hide_' . $hide_notice . '_notice' );
		}
	}

	/**
	 * Add notices + styles if needed.
	 */
	public function add_notices() {
		$screen = get_current_screen();
		$notices = get_option( 'wpclubmanager_admin_notices', array() );

		if ( ! empty( $_GET['hide_theme_support_notice'] ) ) {
			$notices = array_diff( $notices, array( 'theme_support' ) );
			update_option( 'wpclubmanager_admin_notices', $notices );
		}

		if ( ! empty( $_GET['hide_template_files_notice'] ) ) {
			$notices = array_diff( $notices, array( 'template_files' ) );
			update_option( 'wpclubmanager_admin_notices', $notices );
		}

		if ( in_array( 'theme_support', $notices ) && ! current_theme_supports( 'wpclubmanager' ) && ! in_array( $screen->id, array( 'toplevel_page_wpcm-settings', 'dashboard_page_wpcm-about', 'dashboard_page_wpcm-getting-started', 'dashboard_page_wpcm-translators' ) ) ) {
			$template = get_option( 'template' );

			if ( ! in_array( $template, array( 'twentyfifteen', 'twentyfourteen', 'twentythirteen', 'twentyeleven', 'twentytwelve', 'twentyten' ) ) ) {
				wp_enqueue_style( 'wpclubmanager-activation', plugins_url(  '/assets/css/activation.css', WPCM_PLUGIN_FILE ) );
				add_action( 'admin_notices', array( $this, 'theme_check_notice' ) );
			}
		}

		if ( in_array( 'template_files', $notices ) ) {
			wp_enqueue_style( 'wpclubmanager-activation', plugins_url(  '/assets/css/activation.css', WPCM_PLUGIN_FILE ) );
			add_action( 'admin_notices', array( $this, 'template_file_check_notice' ) );
		}

	}

	/**
	 * If we need to update, include a message with the update button
	 */
	public function update_notice() {
		include( 'views/html-notice-update.php' );
	}

	/**
	 * Show the Theme Check notice
	 */
	public function theme_check_notice() {
		if ( ! current_theme_supports( 'wpclubmanager' ) && ! in_array( get_option( 'template' ), wpcm_get_core_supported_themes() ) ) {
			include( 'views/html-notice-theme-support.php' );
		}
	}

	/**
	 * Show a notice highlighting bad template files
	 */
	public function template_file_check_notice() {
		$core_templates = WPCM_Admin_Status::scan_template_files( WPCM()->plugin_path() . '/templates' );
		$outdated       = false;

		foreach ( $core_templates as $file ) {
			$theme_file = false;
			if ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
				$theme_file = get_stylesheet_directory() . '/' . $file;
			} elseif ( file_exists( get_stylesheet_directory() . '/wpclubmanager/' . $file ) ) {
				$theme_file = get_stylesheet_directory() . '/wpclubmanager/' . $file;
			} elseif ( file_exists( get_template_directory() . '/' . $file ) ) {
				$theme_file = get_template_directory() . '/' . $file;
			} elseif( file_exists( get_template_directory() . '/wpclubmanager/' . $file ) ) {
				$theme_file = get_template_directory() . '/wpclubmanager/' . $file;
			}

			if ( $theme_file ) {
				$core_version  = WPCM_Admin_Status::get_file_version( WPCM()->plugin_path() . '/templates/' . $file );
				$theme_version = WPCM_Admin_Status::get_file_version( $theme_file );

				if ( $core_version && $theme_version && version_compare( $theme_version, $core_version, '<' ) ) {
					$outdated = true;
					break;
				}
			}
		}

		if ( $outdated ) {
			include( 'views/html-notice-template-check.php' );
		} else {
			self::remove_notice( 'template_files' );
		}
	}
}

new WPCM_Admin_Notices();