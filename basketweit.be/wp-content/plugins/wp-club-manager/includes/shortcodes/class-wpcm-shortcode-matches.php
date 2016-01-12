<?php
/**
 * Matches Shortcode
 *
 * @author 		Clubpress
 * @category 	Shortcodes
 * @package 	WPClubManager/Shortcodes
 * @version     1.3.3
 */
class WPCM_Shortcode_Matches {

	/**
	 * Output the standings shortcode.
	 *
	 * @param array $atts
	 */
	public static function output( $atts ) {

		extract(shortcode_atts(array(
		), $atts));

		$type 		= ( isset( $atts['type'] ) ? $atts['type'] : '1' );
		$title 		= ( isset( $atts['title'] ) ? $atts['title'] : __( 'Fixtures & Results', 'wp-club-manager' ));
		$comp 		= ( isset( $atts['comp'] ) ? $atts['comp'] : null );
		$season 	= ( isset( $atts['season'] ) ? $atts['season'] : null );
		$team 		= ( isset( $atts['team'] ) ? $atts['team'] : null );
		$month 		= ( isset( $atts['month'] ) ? $atts['month'] : null );
		$venue 		= ( isset( $atts['venue'] ) ? $atts['venue'] : null );
		$thumb 		= ( isset( $atts['thumb'] ) ? $atts['thumb'] : null );
		$link_club  = ( isset( $atts['link_club'] ) ? $atts['link_club'] : null );
		$linktext 	= ( isset( $atts['linktext'] ) ? $atts['linktext'] : __( 'View all results', 'wp-club-manager' ));
		$linkpage 	= ( isset( $atts['linkpage'] ) ? $atts['linkpage'] : null );

		if ( $comp <= 0 )
			$comp = null;
		// if ( $season <= 0  )
		// 	$season = null;
		// if ( $team <= 0  )
		// 	$team = null;
		// if ( $venue <= 0  )
		// 	$venue = null;

		$club = get_default_club();

		// get matches
		$query_args = array(
			'tax_query' => array(),
			'numberposts' => '-1',
			'order' => 'ASC',
			'orderby' => 'post_date',
			'post_type' => 'wpcm_match',
			'post_status' => array('publish','future'),
			'posts_per_page' => '-1'
		);

		if ( isset( $club ) ) {
			$query_args['meta_query'] = array(
				'relation' => 'OR',
				array(
					'key' => 'wpcm_home_club',
					'value' => $club,
				),
				array(
					'key' => 'wpcm_away_club',
					'value' => $club,
				)
			);
		}
		if ( isset( $comp ) ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'wpcm_comp',
				'terms' => $comp,
				'field' => 'term_id'
			);
		}
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
		if ( isset( $venue ) ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'wpcm_venue',
				'terms' => $venue,
				'field' => 'term_id'
			);
		}
		if ( isset( $month ) ) {
			$query_args['date_query'] = array(
				'month' => $month
			);
		}

		$matches = get_posts( $query_args ); ?>

		<?php
		if( $matches ) {
			if( $type == '2' ) {

				if( $title ) { echo '<h3>' . $title . '</h3>'; } ?>

					<ul class="wpcm-matches-list">

			<?php } else { ?>

				<div class="cp-table-wrap wpcm-fixtures-shortcode">

				<table class="cp-table cp-table-full">

				<?php if( $title ) { echo '<caption>' . $title . '</caption>'; } ?>

				<thead>
						
					<tr>
						<th class="wpcm-date"><?php _e('Date', 'wp-club-manager'); ?></th>
						<th class="venue"><?php _e('Venue', 'wp-club-manager'); ?></th>
						<?php if ( $thumb == '1' ) { ?>
							<th class="club-thumb">&nbsp;</th>
						<?php } ?>
						<th class="opponent"><?php _e('Opponent', 'wp-club-manager'); ?></th>
						<th class="competition"><?php _e('Competition', 'wp-club-manager'); ?></th>
						<th class="result"><?php _e('Result', 'wp-club-manager'); ?></th>
					</tr>

				</thead>
				<tbody>
			<?php }
		} else { ?>

			<p><?php _e('No matches played yet.', 'wp-club-manager'); ?></p>

		<?php }

		if ( $matches ) {

			foreach( $matches as $match ) {

				// Get match data
				$sport = get_option( 'wpcm_sport' );
				$format = get_match_title_format();
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
				$match_link = get_post_permalink( $match->ID, false, true );

				// Display Badge
				if( $thumb == '1' ) {
					if ( has_post_thumbnail( $home_club ) ) {
						$home_crest = '<td class="club-thumb">' . get_the_post_thumbnail( $home_club, 'crest-small' ) . '</td>';
					} else {
						$home_crest = '<td class="club-thumb">' . wpcm_crest_placeholder_img( 'crest-small' ) . '</td>';
					}
					if ( has_post_thumbnail( $away_club ) ) {
						$away_crest = '<td class="club-thumb">' . get_the_post_thumbnail( $away_club, 'crest-small' ) . '</td>';
					} else {
						$away_crest = '<td class="club-thumb">' . wpcm_crest_placeholder_img( 'crest-small' ) . '</td>';
					}
				} else {
					$home_crest = '';
					$away_crest = '';
				}

				// Display Outcome
				if ( $home_goals == $away_goals ) {
					$outcome = '<span class="draw"></span>';
					$class = 'draw';
				}
				if ( $club == $home_club ) {
					if ( $home_goals > $away_goals ) {
						$outcome = '<span class="win"></span>';
						$class = 'win';
					}
					if ( $home_goals < $away_goals ) {
						$outcome = '<span class="lose"></span>';
						$class = 'loss';
					}
				} else {
					if ( $home_goals > $away_goals ) {
						$outcome = '<span class="lose"></span>';
						$class = 'loss';
					}
					if ( $home_goals < $away_goals ) {
						$outcome = '<span class="win"></span>';
						$class = 'win';
					}
				}

				// Display venue and opponent
				if ( $type == '1' && $club == $home_club ) {

					if ( $neutral ) {
						$venue = __('N', 'wp-club-manager');
					} else {
						$venue = __('H', 'wp-club-manager');
					}
					$opponent = ( $link_club ? '<a href="' . get_post_permalink( $away_club, false, true ) . '">' : '' ) . '' . get_the_title( $away_club, true ) . '' . ( $link_club ? '</a>' : '');
					$crest = $away_crest;

				} elseif ( $type == '1' && $club == $away_club ) {

					if ( $neutral ) {
						$venue = __('N', 'wp-club-manager');
					} else {
						$venue = __('A', 'wp-club-manager');
					}
					$opponent = ( $link_club ? '<a href="' . get_post_permalink( $home_club, false, true ) . '">' : '' ) . '' . get_the_title( $home_club, true ) . '' . ( $link_club ? '</a>' : '');
					$crest = $home_crest;
				}

				// Display competition
				if ( is_array( $comps ) ) {
					foreach ( $comps as $comp ):
						$comp = reset($comps);
						$t_id = $comp->term_id;
						$comp_meta = get_option( "taxonomy_term_$t_id" );
						$comp_label = $comp_meta['wpcm_comp_label'];
						if ( $comp_label ) {
							$competition = $comp_label . '&nbsp;' . $comp_status;
						} else {
							$competition = $comp->name . '&nbsp;' . $comp_status;
						}
					endforeach;
				}

				// Display result - match.php Template
				if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) {
					$result = ( $played ? __( 'x', 'wp-club-manager' ) . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . __( 'x', 'wp-club-manager' ) : '' );
				} else {
					if( $sport == 'gaelic' ) {
						$result = ( $played ? $home_gaa_goals . '-' . $home_gaa_points . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . $away_gaa_goals . '-' . $away_gaa_points : '' ) . ' ' . ( $played ? $outcome : '' );
					} else {
						$result = ( $played ? $home_goals . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . $away_goals : '' ) . ' ' . ( $played ? $outcome : '' );
					}
				}

				// Display status - match-2.php Template
				if( $played ) {
					$status_class = 'result';
					if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) {
						$status = __('x', 'wp-club-manager' ) . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . __('x', 'wp-club-manager' );
					} else {
						if( $format == '%home% vs %away%' ) {
							if( $sport == 'gaelic' ) {
								$status = $home_gaa_goals . '-' . $home_gaa_points . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . $away_gaa_goals . '-' . $away_gaa_points;
							} else {
								$status = $home_goals . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . $away_goals;
							}
						} else {
							if( $sport == 'gaelic' ) {
								$status = $away_gaa_goals . '-' . $away_gaa_points . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . $home_gaa_goals . '-' . $home_gaa_points;
							} else {
								$status = $away_goals . ' ' . get_option( 'wpcm_match_goals_delimiter' ) . ' ' . $home_goals;
							}
						}
					}
				} else {
					$status_class = 'time';
					$status = date_i18n( $time_format, $timestamp );
				}

				// Display clubs format - match-2.php Template
				if( $format == '%home% vs %away%' ) {
					$side1 = wpcm_get_team_name( $home_club, $match->ID );
					$side2 = wpcm_get_team_name( $away_club, $match->ID );
				} else {
					$side1 = wpcm_get_team_name( $away_club, $match->ID );
					$side2 = wpcm_get_team_name( $home_club, $match->ID );
				}

				if( $type == '2' ) {

					wpclubmanager_get_template( 'shortcodes/matches-2.php', array( 'match_link' => $match_link, 'timestamp' => $timestamp, 'status' => $status, 'status_class' => $status_class, 'competition' => $competition, 'side1' => $side1, 'side2' => $side2, 'class' => $class ) );

				} else {

					wpclubmanager_get_template( 'shortcodes/matches.php', array( 'match_link' => $match_link, 'timestamp' => $timestamp, 'time_format' => $time_format, 'venue' => $venue, 'crest' => $crest, 'opponent' => $opponent, 'competition' => $competition, 'result' => $result, 'class' => $class ) );

				}

			}
		}

		if( $type == '2' ) { ?>

			</ul>

		<?php } else { ?>

			</tbody>
			</table>
			</div>

		<?php
		}

	if ( isset( $linkpage ) ) : ?>
		<a href="<?php echo get_page_link( $linkpage ); ?>" class="wpcm-view-link"><?php echo $linktext; ?></a>
	<?php endif;

	}
}