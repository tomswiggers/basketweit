<?php
/**
 * WPClubManager Club Functions. Code adapted from Football Club Theme by themeboy
 *
 * Functions for clubs.
 *
 * @author 		ClubPress
 * @category 	Core
 * @package 	WPClubManager/Functions
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Get empty club stats row.
 *
 * @access public
 * @return array
 */
if (!function_exists('get_wpcm_club_stats_empty_row')) {
	function get_wpcm_club_stats_empty_row() {

		$wpcm_standings_stats_labels = array(
			'p' => get_option( 'wpcm_standings_p_label' ),
			'w' => get_option( 'wpcm_standings_w_label' ),
			'd' => get_option( 'wpcm_standings_d_label' ),
			'l' => get_option( 'wpcm_standings_l_label' ),
			'otw' => get_option( 'wpcm_standings_otw_label' ),
			'otl' => get_option( 'wpcm_standings_otl_label' ),
			'pct' => get_option( 'wpcm_standings_pct_label' ),
			'f' => get_option( 'wpcm_standings_f_label' ),
			'a' => get_option( 'wpcm_standings_a_label' ),
			'gd' => get_option( 'wpcm_standings_gd_label' ),
			'b' => get_option( 'wpcm_standings_bonus_label' ),
			'pts' => get_option( 'wpcm_standings_pts_label' )
		);

		$output = array();

		foreach( $wpcm_standings_stats_labels as $key => $val ) {

			$output[$key] = 0;
		}

		return $output;
	}
}

/**
 * Get total club stats.
 *
 * @access public
 * @param string $post_id
 * @param string $comp
 * @param string $season
 * @return mixed $output
 */
if (!function_exists('get_wpcm_club_total_stats')) {
	function get_wpcm_club_total_stats( $post_id = null, $comp = null, $season = null ) {

		$output = get_wpcm_club_stats_empty_row();
		$autostats = get_wpcm_club_auto_stats( $post_id, $comp, $season);
		$manualstats = get_wpcm_club_manual_stats( $post_id, $comp, $season);

		foreach( $output as $key => $val ) {

			if( $key == 'pct' ){

				$combined_win = $autostats['w'] + $manualstats['w'];
				$combined_played = $autostats['p'] + $manualstats['p'];
				if( $combined_win > 0 || $combined_played > 0 ) {
					$wpct = $combined_win / $combined_played;
				}else{
					$wpct = '0';
				}

				$output[$key] = round( $wpct, 3 );

			} else {

				$output[$key] = $autostats[$key] + $manualstats[$key];
			}
		}

		return $output;
	}
}

/**
 * Get manual club stats.
 *
 * @access public
 * @param string $post_id
 * @param string $comp
 * @param string $season
 * @return mixed $output
 */
if (!function_exists('get_wpcm_club_manual_stats')) {
	function get_wpcm_club_manual_stats( $post_id = null, $comp = null, $season = null ) {

		$output = get_wpcm_club_stats_empty_row();

		if ( empty ( $comp ) ) $comp = 0;
		if ( empty ( $season ) ) $season = 0;

		$stats = unserialize( get_post_meta( $post_id, 'wpcm_stats', true ) );

		if ( is_array( $stats ) && array_key_exists( $comp, $stats ) ) {

			if ( is_array( $stats[$comp] ) && array_key_exists ( $season, $stats[$comp] ) ) {

				$output = $stats[$comp][$season];
			}
		}

		return $output;
	}
}

/**
 * Get auto club stats.
 *
 * @access public
 * @param string $post_id
 * @param string $comp
 * @param string $season
 * @return mixed $output
 */
if (!function_exists('get_wpcm_club_auto_stats')) {
	function get_wpcm_club_auto_stats( $post_id = null, $comp = null, $season = null ) {

		if ( !$post_id ) global $post_id;

		$output = get_wpcm_club_stats_empty_row();

		// get all home matches
		$args = array(
			'post_type' => 'wpcm_match',
			'meta_key' => 'wpcm_home_club',
			'meta_value' => $post_id,
			'tax_query' => array(),
			'showposts' => -1
		);

		if ( isset( $comp ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'wpcm_comp',
				'terms' => $comp,
				'field' => 'term_id'
			);
		}

		if ( isset( $season ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'wpcm_season',
				'terms' => $season,
				'field' => 'term_id'
			);
		}

		$matches = get_posts( $args );

		foreach( $matches as $match ) {

			$played = get_post_meta( $match->ID, 'wpcm_played', true );
			$friendly = get_post_meta( $match->ID, 'wpcm_friendly', true );

			$overtime = get_post_meta( $match->ID, 'wpcm_overtime', true );

			if ( $played && !$friendly ) {

				$f = get_post_meta( $match->ID, 'wpcm_home_goals', true );
				$a = get_post_meta( $match->ID, 'wpcm_away_goals', true );
				$hb = get_post_meta( $match->ID, 'wpcm_home_bonus', true );
				$won = $overtime == 0 && (int)( $f > $a );
				$draw = (int)( $f == $a );
				$lost = $overtime == 0 && (int)( $f < $a );
				$otw = $overtime == 1 && (int)( $f > $a );
				$otl = $overtime == 1 && (int)( $f < $a );
				$output['p'] ++;
				$output['w'] += $won;
				$output['d'] += $draw;
				$output['l'] += $lost;
				$output['otw'] += $otw;
				$output['otl'] += $otl;
				$output['f'] += $f;
				$output['a'] += $a;
				$output['gd'] += $f - $a;
				$output['b'] += $hb;
				$output['pts'] += $won * get_option( 'wpcm_standings_win_points' ) + $draw * get_option( 'wpcm_standings_draw_points' ) + $lost * get_option( 'wpcm_standings_loss_points' ) + $otl * get_option( 'wpcm_standings_otl_points' ) + $otw * get_option( 'wpcm_standings_otw_points' ) + $hb;
			}
		}

		$args['meta_key'] = 'wpcm_away_club';

		$matches = get_posts( $args );

		foreach( $matches as $match ) {

			$played = get_post_meta( $match->ID, 'wpcm_played', true );
			$friendly = get_post_meta( $match->ID, 'wpcm_friendly', true );

			$overtime = get_post_meta( $match->ID, 'wpcm_overtime', true );

			if ( $played && !$friendly ) {

				$f = get_post_meta( $match->ID, 'wpcm_away_goals', true );
				$a = get_post_meta( $match->ID, 'wpcm_home_goals', true );
				$ab = get_post_meta( $match->ID, 'wpcm_away_bonus', true );
				$won = $overtime == 0 && (int)( $f > $a );
				$draw = (int)( $f == $a );
				$lost = $overtime == 0 && (int)( $f < $a );
				$otw = $overtime == 1 && (int)( $f > $a );
				$otl = $overtime == 1 && (int)( $f < $a );
				$output['p'] ++;
				$output['w'] += $won;
				$output['d'] += $draw;
				$output['l'] += $lost;
				$output['otw'] += $otw;
				$output['otl'] += $otl;
				$output['f'] += $f;
				$output['a'] += $a;
				$output['gd'] += $f - $a;
				$output['b'] += $ab;
				$output['pts'] += $won * get_option( 'wpcm_standings_win_points' ) + $draw * get_option( 'wpcm_standings_draw_points' ) + $lost * get_option( 'wpcm_standings_loss_points' ) + $otl * get_option( 'wpcm_standings_otl_points' ) + $otw * get_option( 'wpcm_standings_otw_points' ) + $ab;
			}
		}

		return $output;
	}
}

/**
 * Get player stats.
 *
 * @access public
 * @param string $post
 * @return mixed $output
 */
if (!function_exists('get_wpcm_club_stats')) {
	function get_wpcm_club_stats( $post = null ) {

		if ( !$post ) global $post;

		$output = array();
		$comps = get_the_terms( $post->ID, 'wpcm_comp' );
		$seasons = get_the_terms( $post->ID, 'wpcm_season' );

		// isolated competition stats
		if ( is_array( $comps ) ) {

			foreach ( $comps as $comp ) {

				// combined season stats per competition
				$stats = get_wpcm_club_auto_stats( $post->ID, $comp->term_id, null );
				$output[$comp->term_id][0] = array(
					'auto' => $stats,
					'total' => $stats
				);

				// isolated season stats per competition
				if ( is_array( $seasons ) ) {

					foreach ( $seasons as $season ) {

						$stats = get_wpcm_club_auto_stats( $post->ID, $comp->term_id, $season->term_id );
						$output[$comp->term_id][$season->term_id] = array(
							'auto' => $stats,
							'total' => $stats
						);
					}
				}
			}
		}

		// combined season stats for combined competitions
		$stats = get_wpcm_club_auto_stats( $post->ID );
		$output[0][0] = array(
			'auto' => $stats,
			'total' => $stats
		);

		// isolated season stats for combined competitions
		if ( is_array( $seasons ) ) {

			foreach ( $seasons as $season ) {

				$stats = get_wpcm_club_auto_stats( $post->ID, null, $season->term_id );
				$output[0][$season->term_id] = array(
					'auto' => $stats,
					'total' => $stats
				);
			}
		}

		// manual stats
		$stats = (array)unserialize( get_post_meta( $post->ID, 'wpcm_stats', true ) );

		if ( is_array( $stats ) ):

			foreach( $stats as $comp_key => $comp_val ):

				if ( is_array( $comp_val ) && array_key_exists( $comp_key, $output ) ):

					foreach( $comp_val as $season_key => $season_val ):

						if ( array_key_exists ( $season_key, $output[$comp_key] ) ) {

							$output[$comp_key][$season_key]['manual'] = $season_val;

							foreach( $output[$comp_key][$season_key]['total'] as $index_key => &$index_val ) {

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
 * Club stats table.
 *
 * @access public
 * @param array
 * @param string $comp
 * @param string $season
 * @return mixed $output
 */
function wpcm_club_stats_table( $stats = array(), $comp = 0, $season = 0 ) {

	$wpcm_standings_stats_labels = array(
		'p' => get_option( 'wpcm_standings_p_label' ),
		'w' => get_option( 'wpcm_standings_w_label' ),
		'd' => get_option( 'wpcm_standings_d_label' ),
		'l' => get_option( 'wpcm_standings_l_label' ),
		'otw' => get_option( 'wpcm_standings_otw_label' ),
		'otl' => get_option( 'wpcm_standings_otl_label' ),
		'pct' => get_option( 'wpcm_standings_pct_label' ),
		'f' => get_option( 'wpcm_standings_f_label' ),
		'a' => get_option( 'wpcm_standings_a_label' ),
		'gd' => get_option( 'wpcm_standings_gd_label' ),
		'b' => get_option( 'wpcm_standings_bonus_label' ),
		'pts' => get_option( 'wpcm_standings_pts_label' )
	);

	if ( array_key_exists( $comp, $stats ) ):

		if ( array_key_exists( $season, $stats[$comp] ) ):

			$stats = $stats[$comp][$season];

		endif;
	endif; ?>

	<table>
		<thead>
			<tr>
				<td>&nbsp;</td>
				<?php foreach( $wpcm_standings_stats_labels as $key => $val ): ?>
					<th><?php echo $val; ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th align="right"><?php _e( 'Total', 'wp-club-manager' ); ?></th>
				<?php foreach( $wpcm_standings_stats_labels as $key => $val ): ?>
					<td><input type="text" data-index="<?php echo $key; ?>" value="<?php wpcm_stats_value( $stats, 'total', $key ); ?>" size="2" tabindex="-1" readonly /></td>
				<?php endforeach; ?>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td align="right"><?php _e( 'Auto', 'wp-club-manager' ); ?></td>
				<?php foreach( $wpcm_standings_stats_labels as $key => $val ): ?>
						<td><input type="text" data-index="<?php echo $key; ?>" value="<?php wpcm_stats_value( $stats, 'auto', $key ); ?>" size="2" tabindex="-1" readonly /></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<td align="right"><?php _e( 'Manual', 'wp-club-manager' ); ?></td>
				<?php foreach( $wpcm_standings_stats_labels as $key => $val ): ?>
					<td><input type="text" data-index="<?php echo $key; ?>" name="wpcm_stats[<?php echo $comp; ?>][<?php echo $season; ?>][<?php echo $key; ?>]" value="<?php wpcm_stats_value( $stats, 'manual', $key ); ?>" size="2" /></td>
				<?php endforeach; ?>
			</tr>
		</tbody>
	</table>
<?php }

/**
 * Standing table sorting.
 *
 * @access public
 * @param array
 * @param array
 * @return int
 */
if ( !function_exists( 'wpcm_club_standings_sort' ) ) {
	function wpcm_club_standings_sort( $a, $b ) {

		if ( $a->wpcm_stats['pts'] > $b->wpcm_stats['pts'] ) {

			return -1;

		} elseif  ( $a->wpcm_stats['pts'] < $b->wpcm_stats['pts'] ) {

			return 1;

		} else {

			if ( $a->wpcm_stats['gd'] > $b->wpcm_stats['gd'] ) {

				return -1;

			} elseif  ($a->wpcm_stats['gd'] < $b->wpcm_stats['gd']) {

				return 1;

			} else {

				if ( $a->wpcm_stats['f'] > $b->wpcm_stats['f'] ) {

					return -1;

				} elseif ( $a->wpcm_stats['f'] < $b->wpcm_stats['f']  ) {

					return 1;

				} else {

					if ( strcmp( $a->post_title, $b->post_title ) < 0 ) {

						return -1;

					} else {

						return 1;
					}
				}
			}
		}
	}
}

/**
 * Standing table sorting.
 *
 * @access public
 * @param array
 * @param array
 * @return int
 */
if ( !function_exists( 'wpcm_club_standings_pct_sort' ) ) {
	function wpcm_club_standings_pct_sort( $a, $b ) {

		if ( $a->wpcm_stats['pct'] > $b->wpcm_stats['pct'] ) {

			return -1;

		} elseif  ( $a->wpcm_stats['pct'] < $b->wpcm_stats['pct'] ) {

			return 1;

		} else {

			if ( $a->wpcm_stats['w'] > $b->wpcm_stats['w'] ) {

				return -1;

			} elseif  ($a->wpcm_stats['w'] < $b->wpcm_stats['w']) {

				return 1;

			} else {

				if ( $a->wpcm_stats['f'] > $b->wpcm_stats['f'] ) {

					return -1;

				} elseif ( $a->wpcm_stats['f'] < $b->wpcm_stats['f']  ) {

					return 1;

				} else {

					if ( strcmp( $a->post_title, $b->post_title ) < 0 ) {

						return -1;

					} else {

						return 1;
					}
				}
			}
		}
	}
}

/**
 * Standing table sort by.
 *
 * @access public
 * @param array
 * @param array
 * @return array
 */
if (!function_exists('wpcm_club_standings_sort_by')) {
	function wpcm_club_standings_sort_by( $subkey, $a ) {

		foreach( $a as $k => $v ) {

			$b[$k] = (float) $v->wpcm_stats[$subkey];
		}

		if ( $b != null ) {

			arsort( $b );
			foreach( $b as $key=>$val ) {

				$c[] = $a[$key];
			}

			return $c;
		}

		return array();
	}
}

if (!function_exists('wpcm_head_to_heads')) {
	function wpcm_head_to_heads( $post ) {

		$club = get_default_club();

		// get matches
		$query_args = array(
			'numberposts' => '-1',
			'order' => 'ASC',
			'orderby' => 'post_date',
			'post_type' => 'wpcm_match',
			'post_status' => array('publish'),
			'posts_per_page' => '-1'
		);


		$query_args['meta_query'] = array(
			'relation' => 'OR',
			array(
				'relation' => 'AND',
				array (
					'key' => 'wpcm_home_club',
					'value' => $club,
				),
				array (
					'key' => 'wpcm_away_club',
					'value' => $post,
				),
			),
			array(
				'relation' => 'AND',
				array (
					'key' => 'wpcm_home_club',
					'value' => $post,
				),
				array (
					'key' => 'wpcm_away_club',
					'value' => $club,
				),
			)
		);

		$matches = get_posts( $query_args );

		$size = count( $matches );

		if ( $size > 0 ) {

			$wins = 0;
			$losses = 0;
			$draws = 0;

			foreach( $matches as $match ) {

				$home_club = get_post_meta( $match->ID, 'wpcm_home_club', true );
				$home_goals = get_post_meta( $match->ID, 'wpcm_home_goals', true );
				$away_goals = get_post_meta( $match->ID, 'wpcm_away_goals', true );

				if ( $home_goals == $away_goals ) {
					$draws ++;
				}

				if ( $club == $home_club ) {
					if ( $home_goals > $away_goals ) {
						$wins ++;
					}
					if ( $home_goals < $away_goals ) {
						$losses ++;
					}
				} else {
					if ( $home_goals > $away_goals ) {
						$losses ++;
					}
					if ( $home_goals < $away_goals ) {
						$wins ++;
					}
				}

			} ?>

			<ul class="wpcm-h2h-list">
				<li class="wpcm-h2h-list-p">
					<span class="wpcm-h2h-list-count"><?php echo $size; ?></span> <span class="wpcm-h2h-list-desc">games</span>
				</li>
				<li class="wpcm-h2h-list-w">
					<span class="wpcm-h2h-list-count"><?php echo $wins; ?></span> <span class="wpcm-h2h-list-desc">wins</span>
				</li>
				<li class="wpcm-h2h-list-d">
					<span class="wpcm-h2h-list-count"><?php echo $draws; ?></span> <span class="wpcm-h2h-list-desc">draws</span>
				</li>
				<li class="wpcm-h2h-list-l">
					<span class="wpcm-h2h-list-count"><?php echo $losses; ?></span> <span class="wpcm-h2h-list-desc">losses</span>
				</li>
			</ul>

			<ul class="wpcm-matches-list">

			<?php
			foreach( $matches as $match ) {
		
				$sport = get_option( 'wpcm_sport' );
				$home_club = get_post_meta( $match->ID, 'wpcm_home_club', true );
				$away_club = get_post_meta( $match->ID, 'wpcm_away_club', true );
				$home_goals = get_post_meta( $match->ID, 'wpcm_home_goals', true );
				$away_goals = get_post_meta( $match->ID, 'wpcm_away_goals', true );
				if( $sport == 'gaelic' ) {
					$home_gaa_goals = get_post_meta( $match->ID, 'wpcm_home_gaa_goals', true );
					$home_gaa_points = get_post_meta( $match->ID, 'wpcm_home_gaa_points', true );
					$away_gaa_goals = get_post_meta( $match->ID, 'wpcm_away_gaa_goals', true );
					$away_gaa_points = get_post_meta( $match->ID, 'wpcm_away_gaa_points', true );
				}
				$played = get_post_meta( $match->ID, 'wpcm_played', true );
				$timestamp = strtotime( $match->post_date );
				$time_format = get_option( 'time_format' );
				$neutral = get_post_meta( $match->ID, 'wpcm_neutral', true );
				$comps = get_the_terms( $match->ID, 'wpcm_comp' );
				$comp_status = get_post_meta( $match->ID, 'wpcm_comp_status', true );

				if ( $home_goals == $away_goals ) {
					$class = 'draw';
				}

				if ( $club == $home_club ) {
					if ( $home_goals > $away_goals ) {
						$class = 'win';
					}
					if ( $home_goals < $away_goals ) {
						$class = 'loss';
					}
				} else {
					if ( $home_goals > $away_goals ) {
						$class = 'loss';
					}
					if ( $home_goals < $away_goals ) {
						$class = 'win';
					}
				}

				if ( is_array( $comps ) ) {
					foreach ( $comps as $comp ):
						$comp = reset($comps);
						$t_id = $comp->term_id;
						$comp_meta = get_option( "taxonomy_term_$t_id" );
						$comp_label = $comp_meta['wpcm_comp_label'];
						if ( $comp_label ) {
							$info = $comp_label . '&nbsp;' . $comp_status;
						} else {
							$info = $comp->name . '&nbsp;' . $comp_status;
						}
					endforeach;
				}

				if( $played ) {
					if( $sport == 'gaelic' ) {
						$status = '<span class="wpcm-matches-list-result">' . ( $played ? $home_gaa_goals . '-' . $home_gaa_points . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . $away_gaa_goals . '-' . $away_gaa_points : '' ) . '</span>';
					} else {
						$status = '<span class="wpcm-matches-list-result">' . ( $played ? $home_goals . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . $away_goals : '' ) . '</span>';
					}
				} else {
					$status = '<span class="wpcm-matches-list-time">' . date_i18n( $time_format, $timestamp ) . '</span>';
				} ?>


				<li class="wpcm-matches-list-item"><a href="<?php echo get_post_permalink( $match->ID, false, true ); ?>" class="wpcm-matches-list-link">
				
				<span class="wpcm-matches-list-col wpcm-matches-list-date"><?php echo date_i18n( 'd M Y', $timestamp ); ?></span>

				<span class="wpcm-matches-list-col wpcm-matches-list-club1"><?php echo wpcm_get_team_name($home_club, $match->ID); ?></span>

				<span class="wpcm-matches-list-col wpcm-matches-list-status">
					<span class="wpcm-matches-list-result <?php echo $class; ?>">
						<?php echo $status; ?>
					</span>
				</span>

				<span class="wpcm-matches-list-col wpcm-matches-list-club2"><?php echo wpcm_get_team_name($away_club, $match->ID); ?></span>

				<span class="wpcm-matches-list-col wpcm-matches-list-info"><?php echo $info; ?></span>

				</a></li>
			<?php
			} ?>

			</ul>

		<?php
		} 
	}
}