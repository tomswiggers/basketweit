<?php
function wpcm_ss_display_scores( $post ) {

	$post_id = get_the_ID();
	$sport = get_option('wpcm_sport');
	$sep = get_option('wpcm_match_goals_delimiter');
	$intgoals = unserialize( get_post_meta( $post_id, 'wpcm_goals', true) );
	$played = get_post_meta( $post_id, 'wpcm_played', true );
	$home_club = get_post_meta( $post_id, 'wpcm_home_club', true );
	$away_club = get_post_meta( $post_id, 'wpcm_away_club', true );

	if( $sport == 'volleyball' ) :

		if ( $played ) : ?>
			<table class="wpcm-ss-table">
				<thead>
					<tr>
						<th></th>
						<?php
						if ( isset( $intgoals['q1'] ) ) { ?>
							<th><?php _e( '1', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q2'] ) ) { ?>
							<th><?php _e( '2', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q3'] ) ) { ?>
							<th><?php _e( '3', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q4'] ) ) { ?>
							<th><?php _e( '4', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q5'] ) ) { ?>
							<th><?php _e( '5', 'wpcm_ss' ); ?></th>
						<?php } ?>
						<th>T</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo get_the_title( $home_club ); ?></td>
						<?php
						if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) { ?>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
						<?php
						} else {
							if ( isset( $intgoals['q1'] ) ) { ?>
								<td><?php echo $intgoals['q1']['home']; ?></td>
							<?php }
							if ( isset( $intgoals['q2'] ) ) { ?>
								<td><?php echo $intgoals['q2']['home']; ?></td>
							<?php }
							if ( isset( $intgoals['q3'] ) ) { ?>
								<td><?php echo $intgoals['q3']['home']; ?></td>
							<?php }
							if ( isset( $intgoals['q4'] ) ) { ?>
								<td><?php echo $intgoals['q4']['home']; ?></td>
							<?php }
							if ( isset( $intgoals['q5'] ) ) { ?>
								<td><?php echo $intgoals['q5']['home']; ?></td>
							<?php } ?>
							<td><?php echo $intgoals['total']['home']; ?></td>
						<?php
						} ?>
					</tr>
					<tr>
						<td><?php echo get_the_title( $away_club ); ?></td>
						<?php
						if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) { ?>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
						<?php
						} else {
							if ( isset( $intgoals['q1'] ) ) { ?>
								<td><?php echo $intgoals['q1']['away']; ?></td>
							<?php }
							if ( isset( $intgoals['q2'] ) ) { ?>
								<td><?php echo $intgoals['q2']['away']; ?></td>
							<?php }
							if ( isset( $intgoals['q3'] ) ) { ?>
								<td><?php echo $intgoals['q3']['away']; ?></td>
							<?php }
							if ( isset( $intgoals['q4'] ) ) { ?>
								<td><?php echo $intgoals['q4']['away']; ?></td>
							<?php }
							if ( isset( $intgoals['q5'] ) ) { ?>
								<td><?php echo $intgoals['q5']['away']; ?></td>
							<?php } ?>
							<td><?php echo $intgoals['total']['away']; ?></td>
						<?php
						} ?>
					</tr>
				</tbody>
			</table>
		<?php
		endif;

	elseif( $sport == 'basketball' || $sport == 'football' || $sport == 'footy' ) :

		if ( $played ) : ?>
			<table class="wpcm-ss-table">
				<thead>
					<tr>
						<th></th>
						<?php
						if ( isset( $intgoals['q1'] ) ) { ?>
							<th><?php _e( '1', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q2'] ) ) { ?>
							<th><?php _e( '2', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q3'] ) ) { ?>
							<th><?php _e( '3', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q4'] ) ) { ?>
							<th><?php _e( '4', 'wpcm_ss' ); ?></th>
						<?php } ?>
						<th>T</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo get_the_title( $home_club ); ?></td>
						<?php
						if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) { ?>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
						<?php
						} else {
							if ( isset( $intgoals['q1'] ) ) { ?>
								<td><?php echo $intgoals['q1']['home']; ?></td>
							<?php }
							if ( isset( $intgoals['q2'] ) ) { ?>
								<td><?php echo $intgoals['q2']['home']; ?></td>
							<?php }
							if ( isset( $intgoals['q3'] ) ) { ?>
								<td><?php echo $intgoals['q3']['home']; ?></td>
							<?php }
							if ( isset( $intgoals['q4'] ) ) { ?>
								<td><?php echo $intgoals['q4']['home']; ?></td>
							<?php } ?>
							<td><?php echo $intgoals['total']['home']; ?></td>
						<?php
						} ?>
					</tr>
					<tr>
						<td><?php echo get_the_title( $away_club ); ?></td>
						<?php
						if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) { ?>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
							<td><?php _e( 'x', 'wpcm_ss' ); ?></td>
						<?php
						} else {
							if ( isset( $intgoals['q1'] ) ) { ?>
								<td><?php echo $intgoals['q1']['away']; ?></td>
							<?php }
							if ( isset( $intgoals['q2'] ) ) { ?>
								<td><?php echo $intgoals['q2']['away']; ?></td>
							<?php }
							if ( isset( $intgoals['q3'] ) ) { ?>
								<td><?php echo $intgoals['q3']['away']; ?></td>
							<?php }
							if ( isset( $intgoals['q4'] ) ) { ?>
								<td><?php echo $intgoals['q4']['away']; ?></td>
							<?php } ?>
							<td><?php echo $intgoals['total']['away']; ?></td>
						<?php
						} ?>
					</tr>
				</tbody>
			</table>
		<?php
		endif;

	elseif( $sport == 'hockey' || $sport == 'floorball' ) :

		$overtime = get_post_meta( $post_id, 'wpcm_overtime', true );
		$shootout = get_post_meta( $post_id, 'wpcm_shootout', true );

		if ( $played ) : ?>
			<table class="wpcm-ss-table">
				<thead>
					<tr>
						<th></th>
						<?php
						if ( isset( $intgoals['q1'] ) ) { ?>
							<th><?php _e( '1', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q2'] ) ) { ?>
							<th><?php _e( '2', 'wpcm_ss' ); ?></th>
						<?php }
						if ( isset( $intgoals['q3'] ) ) { ?>
							<th><?php _e( '3', 'wpcm_ss' ); ?></th>
						<?php }
						if ( $overtime ) { ?>
							<th><?php _e( 'OT', 'wpcm_ss' ); ?></th>
						<?php }
						if ( $shootout ) { ?>
							<th><?php _e( 'SO', 'wpcm_ss' ); ?></th>
						<?php } ?>
						<th>T</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th><?php echo get_the_title( $home_club ); ?></th>
						<?php
						if ( isset( $intgoals['q1'] ) ) { ?>
							<td><?php echo $intgoals['q1']['home']; ?></td>
						<?php }
						if ( isset( $intgoals['q2'] ) ) { ?>
							<td><?php echo $intgoals['q2']['home']; ?></td>
						<?php }
						if ( isset( $intgoals['q3'] ) ) { ?>
							<td><?php echo $intgoals['q3']['home']; ?></td>
						<?php } ?>
						<?php if ( $overtime ) {
							if ( $intgoals['total']['home'] > $intgoals['total']['away'] ) { ?>
								<td><?php _e( '1', 'wpcm_ss' ); ?></td>
							<?php } else { ?>
								<td><?php _e( '0', 'wpcm_ss' ); ?></td>
							<?php }
						} ?>
						<?php if ( $shootout ) {
							if ( $intgoals['total']['home'] > $intgoals['total']['away'] ) { ?>
								<td><?php _e( '1', 'wpcm_ss' ); ?></td>
							<?php } else { ?>
								<td><?php _e( '0', 'wpcm_ss' ); ?></td>
							<?php }
						} ?>
						<td><?php echo $intgoals['total']['home']; ?></td>
					</tr>
					<tr>
						<th><?php echo get_the_title( $away_club ); ?></th>
						<?php
						if ( isset( $intgoals['q1'] ) ) { ?>
							<td><?php echo $intgoals['q1']['away']; ?></td>
						<?php }
						if ( isset( $intgoals['q2'] ) ) { ?>
							<td><?php echo $intgoals['q2']['away']; ?></td>
						<?php }
						if ( isset( $intgoals['q3'] ) ) { ?>
							<td><?php echo $intgoals['q3']['away']; ?></td>
						<?php } ?>
						<?php if ( $overtime ) {
							if ( $intgoals['total']['away'] > $intgoals['total']['home'] ) { ?>
								<td><?php _e( '1', 'wpcm_ss' ); ?></td>
							<?php } else { ?>
								<td><?php _e( '0', 'wpcm_ss' ); ?></td>
							<?php }
						} ?>
						<?php if ( $shootout ) {
							if ( $intgoals['total']['away'] > $intgoals['total']['home'] ) { ?>
								<td><?php _e( '1', 'wpcm_ss' ); ?></td>
							<?php } else { ?>
								<td><?php _e( '0', 'wpcm_ss' ); ?></td>
							<?php }
						} ?>
						<td><?php echo $intgoals['total']['away']; ?></td>
					</tr>
				</tbody>
			</table>
		<?php
		endif;

	else :

		if ( $played ) :
			if ( isset( $intgoals['q1'] ) ) { ?>
				<div class="wpcm-ss-halftime">
					<?php if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) {
						_e( 'HT:', 'wpcm_ss' ); ?> <?php _e( 'x', 'wpcm_ss' ); ?> <?php echo $sep; ?> <?php _e( 'x', 'wpcm_ss' );
					} else {
						_e( 'HT:', 'wpcm_ss' ); ?> <?php echo $intgoals['q1']['home']; ?> <?php echo $sep; ?> <?php echo $intgoals['q1']['away'];
					} ?>
				</div>
			<?php }
		endif;

	endif;
}
add_action( 'wpclubmanager_single_match_fixture', 'wpcm_ss_display_scores', 30 );