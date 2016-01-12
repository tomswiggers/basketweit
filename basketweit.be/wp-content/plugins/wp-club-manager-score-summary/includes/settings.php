<?php
function wpcm_ss_scores_admin( $post ) {

	$post_id = $post;

	$sport = get_option('wpcm_sport');

	if( $sport == 'volleyball' ) :

		$goals = array_merge( array( 'q1' => array( 'home' => 0, 'away' => 0	) ), array( 'q2' => array( 'home' => 0, 'away' => 0	) ), array( 'q3' => array( 'home' => 0, 'away' => 0	) ), array( 'q4' => array( 'home' => 0, 'away' => 0	) ), array( 'q5' => array( 'home' => 0, 'away' => 0	) ), (array)unserialize( get_post_meta( $post_id, 'wpcm_goals', true ) ) ); ?>

		<tr>
			<th align="right"><?php _e( '1st Set', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q1][home]" id="wpcm_goals_q1_home" value="<?php echo (int)$goals['q1']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q1][away]" id="wpcm_goals_q1_away" value="<?php echo (int)$goals['q1']['away']; ?>" size="3" /></td>
		</tr>
		<tr>
			<th align="right"><?php _e( '2nd Set', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q2][home]" id="wpcm_goals_q2_home" value="<?php echo (int)$goals['q2']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q2][away]" id="wpcm_goals_q2_away" value="<?php echo (int)$goals['q2']['away']; ?>" size="3" /></td>
		</tr>
		<tr>
			<th align="right"><?php _e( '3rd Set', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q3][home]" id="wpcm_goals_q3_home" value="<?php echo (int)$goals['q3']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q3][away]" id="wpcm_goals_q3_away" value="<?php echo (int)$goals['q3']['away']; ?>" size="3" /></td>
		</tr>
		<tr>
			<th align="right"><?php _e( '4th Set', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q4][home]" id="wpcm_goals_q4_home" value="<?php echo (int)$goals['q4']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q4][away]" id="wpcm_goals_q4_away" value="<?php echo (int)$goals['q4']['away']; ?>" size="3" /></td>
		</tr>
		<tr class="wpcm-ss-admin-tr-last">
			<th align="right"><?php _e( '5th Set', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q5][home]" id="wpcm_goals_q5_home" value="<?php echo (int)$goals['q5']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q5][away]" id="wpcm_goals_q5_away" value="<?php echo (int)$goals['q5']['away']; ?>" size="3" /></td>
		</tr>

	<?php elseif( $sport == 'basketball' || $sport == 'football' || $sport == 'footy' ) :

		$goals = array_merge( array( 'q1' => array( 'home' => 0, 'away' => 0	) ), array( 'q2' => array( 'home' => 0, 'away' => 0	) ), array( 'q3' => array( 'home' => 0, 'away' => 0	) ), array( 'q4' => array( 'home' => 0, 'away' => 0	) ), (array)unserialize( get_post_meta( $post_id, 'wpcm_goals', true ) ) ); ?>

		<tr>
			<th align="right"><?php _e( '1st Quarter', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q1][home]" id="wpcm_goals_q1_home" value="<?php echo (int)$goals['q1']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q1][away]" id="wpcm_goals_q1_away" value="<?php echo (int)$goals['q1']['away']; ?>" size="3" /></td>
		</tr>
		<tr>
			<th align="right"><?php _e( '2nd Quarter', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q2][home]" id="wpcm_goals_q2_home" value="<?php echo (int)$goals['q2']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q2][away]" id="wpcm_goals_q2_away" value="<?php echo (int)$goals['q2']['away']; ?>" size="3" /></td>
		</tr>
		<tr>
			<th align="right"><?php _e( '3rd Quarter', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q3][home]" id="wpcm_goals_q3_home" value="<?php echo (int)$goals['q3']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q3][away]" id="wpcm_goals_q3_away" value="<?php echo (int)$goals['q3']['away']; ?>" size="3" /></td>
		</tr>
		<tr class="wpcm-ss-admin-tr-last">
			<th align="right"><?php _e( '4th Quarter', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q4][home]" id="wpcm_goals_q4_home" value="<?php echo (int)$goals['q4']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q4][away]" id="wpcm_goals_q4_away" value="<?php echo (int)$goals['q4']['away']; ?>" size="3" /></td>
		</tr>

	<?php elseif( $sport == 'hockey' || $sport == 'floorball' ) :

		$goals = array_merge( array( 'q1' => array( 'home' => 0, 'away' => 0	) ), array( 'q2' => array( 'home' => 0, 'away' => 0	) ), array( 'q3' => array( 'home' => 0, 'away' => 0	) ), (array)unserialize( get_post_meta( $post_id, 'wpcm_goals', true ) ) ); ?>

		<tr>
			<th align="right"><?php _e( '1st Period', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q1][home]" id="wpcm_goals_q1_home" value="<?php echo (int)$goals['q1']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q1][away]" id="wpcm_goals_q1_away" value="<?php echo (int)$goals['q1']['away']; ?>" size="3" /></td>
		</tr>
		<tr>
			<th align="right"><?php _e( '2nd Period', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q2][home]" id="wpcm_goals_q2_home" value="<?php echo (int)$goals['q2']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q2][away]" id="wpcm_goals_q2_away" value="<?php echo (int)$goals['q2']['away']; ?>" size="3" /></td>
		</tr>
		<tr class="wpcm-ss-admin-tr-last">
			<th align="right"><?php _e( '3rd Period', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q3][home]" id="wpcm_goals_q3_home" value="<?php echo (int)$goals['q3']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q3][away]" id="wpcm_goals_q3_away" value="<?php echo (int)$goals['q3']['away']; ?>" size="3" /></td>
		</tr>

	<?php else :

		$goals = array_merge( array( 'q1' => array( 'home' => 0, 'away' => 0	) ), (array)unserialize( get_post_meta( $post_id, 'wpcm_goals', true ) ) ); ?>

		<tr class="wpcm-ss-admin-tr-last">
			<th align="right"><?php _e( 'Half Time', 'wpcm_ss' ); ?></th>
			<td><input type="text" name="wpcm_goals[q1][home]" id="wpcm_goals_q1_home" value="<?php echo (int)$goals['q1']['home']; ?>" size="3" /></td>
			<td><input type="text" name="wpcm_goals[q1][away]" id="wpcm_goals_q1_away" value="<?php echo (int)$goals['q1']['away']; ?>" size="3" /></td>
		</tr>

	<?php endif;

}
add_action( 'wpclubmanager_admin_results_table','wpcm_ss_scores_admin' );