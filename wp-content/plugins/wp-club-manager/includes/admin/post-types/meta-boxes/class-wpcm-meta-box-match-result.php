<?php
/**
 * Match Result
 *
 * Displays the match result box.
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin/Meta Boxes
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Meta_Box_Match_Result {

	/**
	 * Output the metabox
	 */
	public static function output( $post ) {

		wp_nonce_field( 'wpclubmanager_save_data', 'wpclubmanager_meta_nonce' );

		$post_id = $post->ID;
		$sport = get_option('wpcm_sport');

		$played = get_post_meta( $post_id, 'wpcm_played', true );
		$friendly = get_post_meta( $post_id, 'wpcm_friendly', true );
		$overtime = get_post_meta( $post_id, 'wpcm_overtime', true );
		$shootout = get_post_meta( $post_id, 'wpcm_shootout', true );

		$goals = array_merge( array( 'total' => array( 'home' => 0, 'away' => 0	) ), (array)unserialize( get_post_meta( $post_id, 'wpcm_goals', true ) ) );
		$bonus = array_merge( array( 'home' => 0, 'away' => 0	), (array)unserialize( get_post_meta( $post_id, 'wpcm_bonus', true ) ) );
		$gaa_goals = array_merge( array( 'home' => 0, 'away' => 0	), (array)unserialize( get_post_meta( $post_id, 'wpcm_gaa_goals', true ) ) );
		$gaa_points = array_merge( array( 'home' => 0, 'away' => 0	), (array)unserialize( get_post_meta( $post_id, 'wpcm_gaa_points', true ) ) ); ?>

		<p>
			<label class="selectit">
				<input type="checkbox" name="wpcm_played" id="wpcm_played" value="1" <?php checked( true, $played ); ?> />
				<?php _e( 'Result', 'wp-club-manager' ); ?>
			</label>
		</p>
		<div id="results-table">
			<table>
				<thead>
					<tr>
						<td>&nbsp;</td>
						<th><?php _ex( 'Home', 'team', 'wp-club-manager' ); ?></th>
						<th><?php _ex( 'Away', 'team', 'wp-club-manager' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php do_action('wpclubmanager_admin_results_table', $post->ID ); ?>
					<tr>
						<th align="right"><?php _e( 'Score', 'wp-club-manager' ); ?></th>
						<td><input type="text" name="wpcm_goals[total][home]" id="wpcm_goals_total_home" value="<?php echo (int)$goals['total']['home']; ?>" size="3" /></td>
						<td><input type="text" name="wpcm_goals[total][away]" id="wpcm_goals_total_away" value="<?php echo (int)$goals['total']['away']; ?>" size="3" /></td>
					</tr>
				</tbody>
			</table>
			<?php
			if ( $sport == 'rugby') { ?>
				<table class="wpcm-results-bonus">
					<tbody>
						<tr>
							<th align="right"><?php _e( 'Bonus Points', 'wp-club-manager' ); ?></th>
							<td><input type="text" name="wpcm_bonus[home]" id="wpcm_bonus_home" value="<?php echo (int)$bonus['home']; ?>" size="3" /></td>
							<td><input type="text" name="wpcm_bonus[away]" id="wpcm_bonus_away" value="<?php echo (int)$bonus['away']; ?>" size="3" /></td>
						</tr>
					</tbody>
				</table>
			<?php }
			if ( $sport == 'hockey') { ?>
				<p>
					<label class="selectit">
						<input type="checkbox" name="wpcm_overtime" id="wpcm_overtime" value="1" <?php checked( true, $overtime ); ?> />
						<?php _e( 'Overtime', 'wp-club-manager' ); ?>
					</label>
				</p>
				<p>
					<label class="selectit">
						<input type="checkbox" name="wpcm_shootout" id="wpcm_shootout" value="1" <?php checked( true, $shootout ); ?> />
						<?php _e( 'Shootout', 'wp-club-manager' ); ?>
					</label>
				</p>
			<?php }
			if ( $sport == 'gaelic' ) { ?>
				<table class="wpcm-results-gaelic">
					<tbody>
						<tr>
							<th align="right"><?php _e( 'Goals', 'wp-club-manager' ); ?></th>
							<td><input type="text" name="wpcm_gaa_goals[home]" id="wpcm_gaa_goals_home" value="<?php echo (int)$gaa_goals['home']; ?>" size="3" /></td>
							<td><input type="text" name="wpcm_gaa_goals[away]" id="wpcm_gaa_goals_away" value="<?php echo (int)$gaa_goals['away']; ?>" size="3" /></td>
						</tr>
						<tr>
							<th align="right"><?php _e( 'Points', 'wp-club-manager' ); ?></th>
							<td><input type="text" name="wpcm_gaa_points[home]" id="wpcm_gaa_points_home" value="<?php echo (int)$gaa_points['home']; ?>" size="3" /></td>
							<td><input type="text" name="wpcm_gaa_points[away]" id="wpcm_gaa_points_away" value="<?php echo (int)$gaa_points['away']; ?>" size="3" /></td>
						</tr>
					</tbody>
				</table>
			<?php } ?>
		</div>
		<p>
			<label class="selectit">
				<input type="checkbox" name="wpcm_friendly" id="wpcm_friendly" value="1" <?php checked( true, $friendly ); ?> />
				<?php _e( 'Friendly', 'wp-club-manager' ); ?>
			</label>
		</p>

		<?php do_action('wpclubmanager_admin_after_results_table', $post->ID );

	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id, $post ) {

		if(isset($_POST['wpcm_played'])){
			$played = $_POST['wpcm_played'];
		} else {
			$played = null;
		}
		if(isset($_POST['wpcm_friendly'])){
			$friendly = $_POST['wpcm_friendly'];
		} else {
			$friendly = null;
		}
		if(isset($_POST['wpcm_overtime'])){
			$overtime = $_POST['wpcm_overtime'];
		} else {
			$overtime = null;
		}
		if(isset($_POST['wpcm_shootout'])){
			$shootout = $_POST['wpcm_shootout'];
		} else {
			$shootout = null;
		}
		
		$goals = $_POST['wpcm_goals'];

		if(isset($_POST['wpcm_bonus'])){
			$bonus = $_POST['wpcm_bonus'];
		} else {
			$bonus = null;
		}

		if(isset($_POST['wpcm_gaa_goals'])){
			$gaa_goals = $_POST['wpcm_gaa_goals'];
		} else {
			$gaa_goals = null;
		}

		if(isset($_POST['wpcm_gaa_points'])){
			$gaa_points = $_POST['wpcm_gaa_points'];
		} else {
			$gaa_points = null;
		}

		update_post_meta( $post_id, 'wpcm_played', $played );
		update_post_meta( $post_id, 'wpcm_friendly', $friendly );
		update_post_meta( $post_id, 'wpcm_overtime', $overtime );
		update_post_meta( $post_id, 'wpcm_shootout', $shootout );
		update_post_meta( $post_id, 'wpcm_goals', serialize( $goals ) );
		update_post_meta( $post_id, 'wpcm_home_goals', $goals['total']['home'] );
		update_post_meta( $post_id, 'wpcm_away_goals', $goals['total']['away'] );
		update_post_meta( $post_id, 'wpcm_bonus', serialize( $bonus ) );
		update_post_meta( $post_id, 'wpcm_home_bonus', $bonus['home'] );
		update_post_meta( $post_id, 'wpcm_away_bonus', $bonus['away'] );
		update_post_meta( $post_id, 'wpcm_gaa_goals', serialize( $gaa_goals ) );
		update_post_meta( $post_id, 'wpcm_home_gaa_goals', $gaa_goals['home'] );
		update_post_meta( $post_id, 'wpcm_away_gaa_goals', $gaa_goals['away'] );
		update_post_meta( $post_id, 'wpcm_gaa_points', serialize( $gaa_points ) );
		update_post_meta( $post_id, 'wpcm_home_gaa_points', $gaa_points['home'] );
		update_post_meta( $post_id, 'wpcm_away_gaa_points', $gaa_points['away'] );
	}
}