<?php
/**
 * WPClubManager Player Functions. Code adapted from Football Club theme by themeboy.
 *
 * Functions for players.
 *
 * @author 		ClubPress
 * @category 	Core
 * @package 	WPClubManager/Functions
 * @version     1.3.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Get empty player stats row.
 *
 * @access public
 * @return mixed $output
 */
if (!function_exists('get_wpcm_player_stats_empty_row')) {
	function get_wpcm_player_stats_empty_row() {

		$stats_labels = wpcm_get_sports_stats_labels();

		$output = array( 'appearances' => 0 );

		foreach( $stats_labels as $key => $val ) {
			$output[$key] = 0;
		}

		return $output;
	}
}

/**
 * Get total player stats.
 *
 * @access public
 * @param string $post_id
 * @param string $team
 * @param string $season
 * @return mixed $output
 */
if (!function_exists('get_wpcm_player_total_stats')) {
	function get_wpcm_player_total_stats( $post_id = null, $team = null, $season = null ) {

		$output = get_wpcm_player_stats_empty_row();
		$autostats = get_wpcm_player_auto_stats( $post_id, $team, $season);
		$manualstats = get_wpcm_player_manual_stats( $post_id, $team, $season);

		foreach( $output as $key => $val ) {
			$output[$key] = $autostats[$key] + $manualstats[$key];
		}

		return $output;
	}
}

/**
 * Get manual player stats.
 *
 * @access public
 * @param string $post_id
 * @param string $team
 * @param string $season
 * @return mixed $output
 */
if (!function_exists('get_wpcm_player_manual_stats')) {
	function get_wpcm_player_manual_stats( $post_id = null, $team = null, $season = null ) {

		$output = get_wpcm_player_stats_empty_row();

		if ( empty ( $team ) ) $team = 0;
		if ( empty ( $season ) ) $season = 0;

		$stats = unserialize( get_post_meta( $post_id, 'wpcm_stats', true ) );

		if ( is_array( $stats ) && array_key_exists( $team, $stats ) ) {
			if ( is_array( $stats[$team] ) && array_key_exists ( $season, $stats[$team] ) ) {
				$output = $stats[$team][$season];
			}
		}

		return $output;
	}
}
/**
 * Get auto player stats.
 *
 * @access public
 * @param string $post_id
 * @param string $team_id
 * @param string $season_id
 * @return mixed $output
 */
if (!function_exists('get_wpcm_player_auto_stats')) {
	function get_wpcm_player_auto_stats( $post_id = null, $team = null, $season_id = null ) {

		if ( !$post_id ) global $post_id;

		$stats_labels = wpcm_get_sports_stats_labels();

		$club_id = get_post_meta( $post_id, 'wpcm_club', true );
		$output = get_wpcm_player_stats_empty_row();

		// get all home matches
		$args = array(
			'post_type' => 'wpcm_match',
			'tax_query' => array(),
			'showposts' => -1,
			'meta_query' => array(
				array(
					'key' => 'wpcm_home_club',
					'value' => $club_id
				),
				array(
					'key' => 'wpcm_friendly',
					'value' => '1',
					'compare' => '!='
				),
			)
		);

		if ( isset( $team ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'wpcm_team',
				'terms' => $team,
				'field' => 'term_id'
			);
		}

		if ( isset( $season_id ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'wpcm_season',
				'terms' => $season_id
			);
		}

		$matches = get_posts( $args );

		foreach( $matches as $match ) {

			$all_players = unserialize( get_post_meta( $match->ID, 'wpcm_players', true ) );

			if ( is_array( $all_players ) ) {

				foreach( $all_players as $players ) {

					if ( is_array( $players ) && array_key_exists( $post_id, $players ) ) {

						$stats = $players[$post_id];
						$output['appearances'] ++;

						foreach( $stats as $key => $value ) {
							if ( array_key_exists( $key, $stats_labels ) )  {
								if(isset($stats[ $key ])){ $output[ $key ] += $stats[ $key ]; }
							}
						}
					}
				}
			}
		}

		// get all away matches
		$args['meta_query'] = array(
			array(
				'key' => 'wpcm_away_club',
				'value' => $club_id
			)
		);
		$matches = get_posts( $args );

		foreach( $matches as $match ) {

			$all_players = unserialize( get_post_meta( $match->ID, 'wpcm_players', true ) );

			if ( is_array( $all_players ) ) {

				foreach( $all_players as $players ) {

					if ( is_array( $players ) && array_key_exists( $post_id, $players ) ) {

						$stats = $players[$post_id];
						$output['appearances'] ++;
						
						foreach( $stats as $key => $value ) {
							if ( array_key_exists( $key, $stats_labels ) )  {
								if(isset($stats[ $key ])){ $output[ $key ] += $stats[ $key ]; }
							}
						}
					}
				}
			}
		}

		return $output;
	}
}

/**
 * Get total player stats.
 *
 * @access public
 * @param string $post_id
 * @return mixed $output
 */
if (!function_exists('get_wpcm_player_stats')) {
	function get_wpcm_player_stats( $post = null ) {

		if ( !$post ) global $post;

		$output = array();
		$teams = get_the_terms( $post->ID, 'wpcm_team' );
		$seasons = get_the_terms( $post->ID, 'wpcm_season' );

		// isolated team stats
		if ( is_array( $teams ) ) {

			foreach ( $teams as $team ) {

				// combined season stats per team
				$stats = get_wpcm_player_auto_stats( $post->ID, $team->term_id, null );
				$output[$team->term_id][0] = array(
					'auto' => $stats,
					'total' => $stats
				);

				// isolated season stats per team
				if ( is_array( $seasons ) ) {

					foreach ( $seasons as $season ) {

						$stats = get_wpcm_player_auto_stats( $post->ID, $team->term_id, $season->term_id );
						$output[$team->term_id][$season->term_id] = array(
							'auto' => $stats,
							'total' => $stats
						);
					}
				}
			}
		}

		// combined season stats for combined team
		$stats = get_wpcm_player_auto_stats( $post->ID );
		$output[0][0] = array(
			'auto' => $stats,
			'total' => $stats
		);

		// isolated season stats for combined team
		if ( is_array( $seasons ) ) {

			foreach ( $seasons as $season ) {

				$stats = get_wpcm_player_auto_stats( $post->ID, null, $season->term_id );
				$output[0][$season->term_id] = array(
					'auto' => $stats,
					'total' => $stats
				);
			}
		}

		// manual stats
		$stats = (array)unserialize( get_post_meta( $post->ID, 'wpcm_stats', true ) );
		if ( is_array( $stats ) ):

			foreach( $stats as $team_key => $team_val ):

				if ( is_array( $team_val ) && array_key_exists( $team_key, $output ) ):

					foreach( $team_val as $season_key => $season_val ):

						if ( array_key_exists ( $season_key, $output[$team_key] ) ) {

							$output[$team_key][$season_key]['manual'] = $season_val;

							foreach( $output[$team_key][$season_key]['total'] as $index_key => &$index_val ) {

								if ( array_key_exists( $index_key, $season_val ) )

								 $index_val += $season_val[$index_key];
							}
						}
					endforeach;
				endif;
			endforeach;
		endif;

		return $output;
	}
}

/**
 * Get total player stats.
 *
 * @access public
 * @param string $post_id
 * @return mixed $output
 */
if (!function_exists('get_wpcm_player_stats_from_post')) {
	function get_wpcm_player_stats_from_post( $post = null ) {

		if ( !$post ) global $post;

		$output = array();
		$teams = get_the_terms( $post, 'wpcm_team' );
		$seasons = get_the_terms( $post, 'wpcm_season' );

		// isolated team stats
		if ( is_array( $teams ) ) {

			foreach ( $teams as $team ) {

				// combined season stats per team
				$stats = get_wpcm_player_auto_stats( $post, $team->term_id, null );
				$output[$team->term_id][0] = array(
					'auto' => $stats,
					'total' => $stats
				);

				// isolated season stats per team
				if ( is_array( $seasons ) ) {

					foreach ( $seasons as $season ) {

						$stats = get_wpcm_player_auto_stats( $post, $team->term_id, $season->term_id );
						$output[$team->term_id][$season->term_id] = array(
							'auto' => $stats,
							'total' => $stats
						);
					}
				}
			}
		}

		// combined season stats for combined team
		$stats = get_wpcm_player_auto_stats( $post );
		$output[0][0] = array(
			'auto' => $stats,
			'total' => $stats
		);

		// isolated season stats for combined team
		if ( is_array( $seasons ) ) {

			foreach ( $seasons as $season ) {

				$stats = get_wpcm_player_auto_stats( $post, null, $season->term_id );
				$output[0][$season->term_id] = array(
					'auto' => $stats,
					'total' => $stats
				);
			}
		}

		// manual stats
		$stats = (array)unserialize( get_post_meta( $post, 'wpcm_stats', true ) );
		if ( is_array( $stats ) ):

			foreach( $stats as $team_key => $team_val ):

				if ( is_array( $team_val ) && array_key_exists( $team_key, $output ) ):

					foreach( $team_val as $season_key => $season_val ):

						if ( array_key_exists ( $season_key, $output[$team_key] ) ) {

							$output[$team_key][$season_key]['manual'] = $season_val;

							foreach( $output[$team_key][$season_key]['total'] as $index_key => &$index_val ) {

								if ( array_key_exists( $index_key, $season_val ) )

								 $index_val += $season_val[$index_key];
							}
						}
					endforeach;
				endif;
			endforeach;
		endif;

		return $output;
	}
}

/**
 * Player stats table.
 *
 * @access public
 * @param array
 * @param string $team
 * @param string $season
 * @return void
 */
function wpcm_player_stats_table( $stats = array(), $team = 0, $season = 0 ) {

	if ( array_key_exists( $team, $stats ) ):

		if ( array_key_exists( $season, $stats[$team] ) ):

			$stats = $stats[$team][$season];
		endif;
	endif;

	$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();

	$stats_labels = array( 'appearances' => __( 'Apps', 'wp-club-manager' ) );
	$stats_labels = array_merge( $stats_labels, $wpcm_player_stats_labels ); ?>

	<table>
		<thead>
			<tr>
				<td>&nbsp;</td>
				<?php foreach( $stats_labels as $key => $val ):
					if( get_option( 'wpcm_show_stats_' . $key ) == 'yes' ) : ?>
						<th><?php echo $val; ?></th>
					<?php endif;
				endforeach; ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th align="right">Total</th>
				<?php foreach( $stats_labels as $key => $val ):
					if( get_option( 'wpcm_show_stats_' . $key ) == 'yes' ) : ?>
						<td><input type="text" data-index="<?php echo $key; ?>" value="<?php wpcm_stats_value( $stats, 'total', $key ); ?>" size="3" tabindex="-1" class="player-stats-total-<?php echo $key; ?>" readonly /></td>
					<?php endif;
				endforeach; ?>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td align="right"><?php _e( 'Auto' ); ?></td>
				<?php foreach( $stats_labels as $key => $val ):
					if( get_option( 'wpcm_show_stats_' . $key ) == 'yes' ) : ?>
						<td><input type="text" data-index="<?php echo $key; ?>" value="<?php wpcm_stats_value( $stats, 'auto', $key ); ?>" size="3" tabindex="-1" class="player-stats-auto-<?php echo $key; ?>" readonly /></td>
					<?php endif;
				endforeach; ?>
			</tr>
			<tr>
				<td align="right"><?php _e( 'Manual', 'wp-club-manager' ); ?></td>
				<?php foreach( $stats_labels as $key => $val ):
					if( get_option( 'wpcm_show_stats_' . $key ) == 'yes' ) : ?>
						<td><input type="text" data-index="<?php echo $key; ?>" name="wpcm_stats[<?php echo $team; ?>][<?php echo $season; ?>][<?php echo $key; ?>]" value="<?php wpcm_stats_value( $stats, 'manual', $key ); ?>" size="3" class="player-stats-manual-<?php echo $key; ?>"<?php echo ( $season == 0 ? ' readonly' : '' ); ?> /></td>
					<?php endif;
				endforeach; ?>
			</tr>
		</tbody>
	</table>

<?php
}

/**
 * Player profile stats table.
 *
 * @access public
 * @param array
 * @param string $team
 * @param string $season
 * @return void
 */
function wpcm_profile_stats_table( $stats = array(), $team = 0, $season = 0 ) {

	$id = get_the_ID();

	if ( array_key_exists( $team, $stats ) ):

		if ( array_key_exists( $season, $stats[$team] ) ):

			$stats = $stats[$team][$season];
		endif;
	endif;

	$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();

	$stats_labels = array( 'appearances' => '<a title="' . __('Games Played', 'wp-club-manager') . '">' . __( 'GP', 'wp-club-manager' ) . '</a>' );
	$stats_labels = array_merge( $stats_labels, $wpcm_player_stats_labels ); ?>

	<table>
		<thead>
			<tr>
				<?php
				foreach( $stats_labels as $key => $val ) { 

					if( get_option( 'wpcm_show_stats_' . $key ) == 'yes' ) { ?>

						<th><?php echo $val; ?></th>
					<?php
					}

				} ?>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php
				foreach( $stats_labels as $key => $val ) {

					if( $key == 'appearances' ) {

						if( get_option( 'wpcm_show_stats_appearances' ) == 'yes' ) { 

							if( get_option( 'wpcm_show_stats_subs' ) == 'yes' ) { 
								$subs = get_player_subs_total( $id, $season, $team );
								if( $subs > 0 ) {
									$sub = ' <span class="sub-appearances">(' . $subs . ')</span>';
								}else{
									$sub = '';
								}
							} ?>
					
							<td><span data-index="appearances"><?php wpcm_stats_value( $stats, 'total', 'appearances' ); ?><?php echo ( get_option( 'wpcm_show_stats_subs' ) == 'yes' ? $sub : '' ); ?></span></td>

						<?php
						}

					} elseif( $key == 'rating' ) {

						$rating = get_wpcm_stats_value( $stats, 'total', 'rating' );
						$apps = get_wpcm_stats_value( $stats, 'total', 'appearances' );
						$avrating = wpcm_divide( $rating, $apps );

						if( get_option( 'wpcm_show_stats_rating' ) == 'yes' ) { ?>
					
							<td><span data-index="rating"><?php echo sprintf( "%01.2f", round($avrating, 2) ); ?></span></td>

						<?php
						}

					} else { 

						if( get_option( 'wpcm_show_stats_' . $key ) == 'yes' ) { ?>

							<td><span data-index="<?php echo $key; ?>"><?php wpcm_stats_value( $stats, 'total', $key ); ?></span></td>
						<?php
						}
					}
				} ?>
				
			</tr>
		</tbody>
	</table>
<?php
}

function get_player_subs_total( $id = null, $season = null, $team = null ) {

	//$id = get_the_ID();

	// convert atts to something more useful
	if ( $season <= 0  )
		$season = null;
	if ( $team <= 0  )
		$team = null;

	$default_club = get_option( 'wpcm_default_club' );

	// get results
	$query_args = array(
		'tax_query' => array(),
		'numberposts' => '-1',
		'order' => 'ASC',
		'orderby' => 'post_date',
		'post_type' => 'wpcm_match',
		'post_status' => 'publish',
		'posts_per_page' => '-1'
	);
	$query_args['meta_query'] = array(
		'relation' => 'OR',
		array(
			'key' => 'wpcm_home_club',
			'value' => $default_club,
		),
		array(
			'key' => 'wpcm_away_club',
			'value' => $default_club,
		)
	);
	if ( isset( $season ) ) {
		$query_args['tax_query'][] = array(
			'taxonomy' => 'wpcm_season',
			'terms' => $season,
			'field' => 'term_id'
		);
	}
	if ( isset( $team ) ) {
		$query_args['tax_query'][] = array(
			'taxonomy' => 'wpcm_team',
			'terms' => $team,
			'field' => 'term_id'
		);
	}

	$matches = get_posts( $query_args );

	$size = sizeof( $matches );

	$total_subs = '0';

	if ( $size > 0 ) {

		$total_subs = 0;

		foreach( $matches as $match ) {

			$player = unserialize( get_post_meta( $match->ID, 'wpcm_players', true ) );

			if( is_array($player) && array_key_exists('subs', $player) && array_key_exists($id, $player['subs']) ) {

				$total_subs ++;

			}
		}
	}


	return $total_subs;
}