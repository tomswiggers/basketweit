<?php
/**
 * Sponsor Url
 *
 * Displays the sponsor url box.
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin/Meta Boxes
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Meta_Box_Sponsor_Url {

	/**
	 * Output the metabox
	 */
	public static function output( $post ) {

		global $post;

		$post_id = $post->ID;
		$link_new_window = get_post_meta( $post_id, 'wpcm_link_nw', true );

		wp_nonce_field( 'wpclubmanager_save_data', 'wpclubmanager_meta_nonce' );

		do_action('wpclubmanager_before_admin_sponsors_meta', $post_id );

		wpclubmanager_wp_text_input( array( 'id' => 'wpcm_link_url', 'label' => __( 'Link URL', 'wp-club-manager' ), 'class' => 'regular-text' ) ); ?>

		<p class="wpcm_link_nw_field">
			<label for="wpcm_link_nw"><?php _e( 'Open link in new window?', 'wp-club-manager' ); ?></label>
			<input type="checkbox" name="wpcm_link_nw" id="wpcm_link_nw" value="1" <?php checked( true, $link_new_window ); ?> />
		</p>

		<?php do_action('wpclubmanager_after_admin_sponsors_meta' );
	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id, $post ) {

		$link_new_window = $_POST['wpcm_link_nw'];
		$link_url = $_POST['wpcm_link_url'];

		if( isset( $link_new_window ) ) {
			update_post_meta( $post_id, 'wpcm_link_nw', $link_new_window );
		}
		if ( isset( $link_url ) ) {
			update_post_meta( $post_id, 'wpcm_link_url', $link_url );
		}

		do_action('wpclubmanager_after_admin_sponsors_save', $post_id );
	}
}