<?php
/**
 * Match Details
 *
 * Displays the match details box.
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin/Meta Boxes
 * @version     1.3.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Meta_Box_Match_Details {

	/**
	 * Output the metabox
	 */
	public static function output( $post ) {

		wp_nonce_field( 'wpclubmanager_save_data', 'wpclubmanager_meta_nonce' );

		$post_id = $post->ID;

		$comps = get_the_terms( $post_id, 'wpcm_comp' );
		$wpcm_comp_status = get_post_meta( $post_id, 'wpcm_comp_status', true );
		$team = get_post_meta( $post_id, 'wpcm_team', true );
		$neutral = get_post_meta( $post_id, 'wpcm_neutral', true );

		if ( is_array( $comps ) ) {
			$comp = $comps[0]->term_id;
			$comp_slug = $comps[0]->slug;
		} else {
			$comp = 0;
			$comp_slug = null;
		}

		$seasons = get_the_terms( $post->ID, 'wpcm_season' );

		if ( is_array( $seasons ) ) {
			$season = $seasons[0]->term_id;
		} else {
			$season = -1;
		}

		$teams = get_the_terms( $post->ID, 'wpcm_team' );

		if ( is_array( $teams ) ) {
			$team = $teams[0]->term_id;
		} else {
			$team = -1;
		}

		$venues = get_the_terms( $post->ID, 'wpcm_venue' );

		if ( is_array( $venues ) ) {
			$venue = $venues[0]->term_id;
		} else {
			$venue = -1;
		} ?>

		<p>
			<label><?php _e( 'Competition', 'wp-club-manager' ); ?></label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'None' ),
				'orderby' => 'title',
				'hide_empty' => false,
				'taxonomy' => 'wpcm_comp',
				'selected' => $comp,
				'name' => 'wpcm_comp',
				'class' => 'chosen_select'
			));
			?>
			<input type="text" name="wpcm_comp_status" id="wpcm_comp_status" value="<?php echo $wpcm_comp_status; ?>" placeholder="Round (Optional)" />
		</p>
		<p>
			<label><?php _e( 'Season', 'wp-club-manager' ); ?></label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'None' ),
				'orderby' => 'title',
				'hide_empty' => false,
				'taxonomy' => 'wpcm_season',
				'selected' => $season,
				'name' => 'wpcm_season',
				'class' => 'chosen_select'
			));
			?>
		</p>
		<p>
			<label><?php _e( 'Team', 'wp-club-manager' ); ?></label>
			<?php
			wp_dropdown_categories(array(
				'show_option_all' => __( 'All' ),
				'orderby' => 'title',
				'hide_empty' => false,
				'taxonomy' => 'wpcm_team',
				'selected' => $team,
				'name' => 'wpcm_match_team',
				'class' => 'chosen_select'
			));
			?>
		</p>
		<p>
			<label><?php _e( 'Venue', 'wp-club-manager' ); ?></label>
			<?php
			wp_dropdown_categories( array(
				'show_option_none' => __( 'None' ),
				'orderby' => 'title',
				'hide_empty' => false,
				'taxonomy' => 'wpcm_venue',
				'selected' => $venue,
				'name' => 'wpcm_venue',
				'class' => 'chosen_select'
			) );
			?>
			<label class="selectit wpcm-cb-block">
				<input type="checkbox" name="wpcm_neutral" id="wpcm_neutral" value="1" <?php checked( true, $neutral ); ?> />
				<?php _e( 'Neutral?', 'wp-club-manager' ); ?>
			</label>
		</p> <?php

		wpclubmanager_wp_text_input( array( 'id' => 'wpcm_attendance', 'label' => __( 'Attendance', 'wp-club-manager' ), 'class' => 'small-text' ) );

		wpclubmanager_wp_text_input( array( 'id' => 'wpcm_referee', 'label' => __( 'Referee', 'wp-club-manager' ), 'class' => 'regular-text' ) );
	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id, $post ) {

		$comp = $_POST['wpcm_comp'];
		$season = $_POST['wpcm_season'];
		wp_set_post_terms( $post_id, $comp, 'wpcm_comp' );
		update_post_meta( $post_id, 'wpcm_comp_status', $_POST['wpcm_comp_status'] );

		wp_set_post_terms( $post_id, $season, 'wpcm_season' );

		// if(isset($_POST['wpcm_teams'])){
		// 	$teams = $_POST['wpcm_teams'];
		// }

		if(isset($_POST['wpcm_match_team'])){
			$team = $_POST['wpcm_match_team'];
		} else {
			$team = null;
		}
		
		update_post_meta( $post_id, 'wpcm_team', $team );
		wp_set_post_terms( $post_id, $team, 'wpcm_team' );

		$venue = $_POST['wpcm_venue'];
		wp_set_post_terms( $post_id, $venue, 'wpcm_venue' );

		if(isset($_POST['wpcm_neutral'])){
			$neutral = $_POST['wpcm_neutral'];
		} else {
			$neutral = null;
		}
		update_post_meta( $post_id, 'wpcm_neutral', $neutral );

		update_post_meta( $post_id, 'wpcm_referee', $_POST['wpcm_referee'] );
		update_post_meta( $post_id, 'wpcm_attendance', $_POST['wpcm_attendance'] );

		do_action('wpclubmanager_after_admin_match_save', $post_id );
	}
}