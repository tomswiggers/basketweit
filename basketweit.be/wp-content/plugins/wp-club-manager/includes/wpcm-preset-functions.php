<?php
/**
 * Preset Functions
 *
 * @author 		ClubPress
 * @category 	Core
 * @package 	WPClubManager/Functions
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Sports presets
 *
 * Get an array of sport options and settings.
 * @return array
 */
function wpcm_get_sport_presets() {
	return apply_filters( 'wpcm_sports', array(
		'baseball' => array(
			'name' => __( 'Baseball', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => '',
						'slug' => '',
					),
				),
			),
			'stats_labels' => array(
				'ab' => '<a title="' . __('At Bats', 'wp-club-manager'). '">' . __('AB', 'wp-club-manager') . '</a>',
				'h' => '<a title="' . __('Hits', 'wp-club-manager'). '">' . __('H', 'wp-club-manager') . '</a>',
				'r' => '<a title="' . __('Runs', 'wp-club-manager'). '">' . __('R', 'wp-club-manager') . '</a>',
				'er' => '<a title="' . __('Earned Runs', 'wp-club-manager'). '">' . __('ER', 'wp-club-manager') . '</a>',
				'hr' => '<a title="' . __('Home Runs', 'wp-club-manager'). '">' . __('HR', 'wp-club-manager') . '</a>',
				'2b' => '<a title="' . __('Doubles', 'wp-club-manager'). '">' . __('2B', 'wp-club-manager') . '</a>',
				'3b' => '<a title="' . __('Triples', 'wp-club-manager'). '">' . __('3B', 'wp-club-manager') . '</a>',
				'rbi' => '<a title="' . __('Runs Batted In', 'wp-club-manager'). '">' . __('RBI', 'wp-club-manager') . '</a>',
				'bb' => '<a title="' . __('Bases on Bulk', 'wp-club-manager'). '">' . __('BB', 'wp-club-manager') . '</a>',
				'so' => '<a title="' . __('Strike Outs', 'wp-club-manager'). '">' . __('SO', 'wp-club-manager') . '</a>',
				'sb' => '<a title="' . __('Stolen Bases', 'wp-club-manager'). '">' . __('SB', 'wp-club-manager') . '</a>',
				'cs' => '<a title="' . __('Caught Stealing', 'wp-club-manager'). '">' . __('CS', 'wp-club-manager') . '</a>',
				'tc' => '<a title="' . __('Total Chances', 'wp-club-manager'). '">' . __('TC', 'wp-club-manager') . '</a>',
				'po' => '<a title="' . __('Putouts', 'wp-club-manager'). '">' . __('PO', 'wp-club-manager') . '</a>',
				'a' => '<a title="' . __('Assists', 'wp-club-manager'). '">' . __('A', 'wp-club-manager') . '</a>',
				'e' => '<a title="' . __('Errors', 'wp-club-manager'). '">' . __('E', 'wp-club-manager') . '</a>',
				'dp' => '<a title="' . __('Double Plays', 'wp-club-manager'). '">' . __('DP', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'basketball' => array(
			'name' => __( 'Basketball', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Point Guard',
						'slug' => 'pointguard',
					),
					array(
						'name' => 'Shooting Guard',
						'slug' => 'shootingguard',
					),
					array(
						'name' => 'Small Forward',
						'slug' => 'smallforward',
					),
					array(
						'name' => 'Power Forward',
						'slug' => 'powerforward',
					),
					array(
						'name' => 'Center',
						'slug' => 'center',
					),
				),
			),
			'stats_labels' => array(
				'min' => '<a title="' . __('Minutes', 'wp-club-manager'). '">' . __('MIN', 'wp-club-manager') . '</a>',
				'fgm' => '<a title="' . __('Field Goals Made', 'wp-club-manager'). '">' . __('FGM', 'wp-club-manager') . '</a>',
				'fga' => '<a title="' . __('Field Goals Attempted', 'wp-club-manager'). '">' . __('FGA', 'wp-club-manager') . '</a>',
				'3pm' => '<a title="' . __('3 Points Made', 'wp-club-manager'). '">' . __('3PM', 'wp-club-manager') . '</a>',
				'3pa' => '<a title="' . __('3 Ponits Attempted', 'wp-club-manager'). '">' . __('3PA', 'wp-club-manager') . '</a>',
				'ftm' => '<a title="' . __('Free Throws Made', 'wp-club-manager'). '">' . __('FTM', 'wp-club-manager') . '</a>',
				'fta' => '<a title="' . __('Free Throws Attempted', 'wp-club-manager'). '">' . __('FTA', 'wp-club-manager') . '</a>',
				'or' => '<a title="' . __('Offensive Rebounds', 'wp-club-manager'). '">' . __('OR', 'wp-club-manager') . '</a>',
				'dr' => '<a title="' . __('Defensive Rebounds', 'wp-club-manager'). '">' . __('DR', 'wp-club-manager') . '</a>',
				'reb' => '<a title="' . __('Rebounds', 'wp-club-manager'). '">' . __('REB', 'wp-club-manager') . '</a>',
				'ast' => '<a title="' . __('Assists', 'wp-club-manager'). '">' . __('AST', 'wp-club-manager') . '</a>',
				'blk' => '<a title="' . __('Blocks', 'wp-club-manager'). '">' . __('BLK', 'wp-club-manager') . '</a>',
				'stl' => '<a title="' . __('Steals', 'wp-club-manager'). '">' . __('STL', 'wp-club-manager') . '</a>',
				'pf' => '<a title="' . __('Personal Fouls', 'wp-club-manager'). '">' . __('PF', 'wp-club-manager') . '</a>',
				'to' => '<a title="' . __('Turnovers', 'wp-club-manager'). '">' . __('TO', 'wp-club-manager') . '</a>',
				'pts' => '<a title="' . __('Points', 'wp-club-manager'). '">' . __('PTS', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'floorball' => array(
			'name' => __( 'Floorball', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalkeeper',
						'slug' => 'goalkeeper',
					),
					array(
						'name' => 'Defender',
						'slug' => 'defender',
					),
					array(
						'name' => 'Forward',
						'slug' => 'forward',
					),
				),
			),
			'stats_labels' => array(
				'g' => '<a title="' . __('Goals', 'wp-club-manager'). '">' . __('G', 'wp-club-manager') . '</a>',
				'a' => '<a title="' . __('Assists', 'wp-club-manager'). '">' . __('A', 'wp-club-manager') . '</a>',
				'plusminus' => '<a title="' . __('Plus/Minus Rating', 'wp-club-manager'). '">' . __('+/-', 'wp-club-manager') . '</a>',
				'sog' => '<a title="' . __('Shots on Goal', 'wp-club-manager'). '">' . __('SOG', 'wp-club-manager') . '</a>',
				'pim' => '<a title="' . __('Penalty Minutes', 'wp-club-manager'). '">' . __('PIM', 'wp-club-manager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wp-club-manager'). '">' . __('RC', 'wp-club-manager') . '</a>',
				'sav' => '<a title="' . __('Saves', 'wp-club-manager'). '">' . __('SAV', 'wp-club-manager') . '</a>',
				'ga' => '<a title="' . __('Goals Against', 'wp-club-manager'). '">' . __('GA', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'football' => array(
			'name' => __( 'American Football', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Quarterback',
						'slug' => 'quarterback',
					),
					array(
						'name' => 'Running Back',
						'slug' => 'runningback',
					),
					array(
						'name' => 'Wide Receiver',
						'slug' => 'widereceiver',
					),
					array(
						'name' => 'Tight End',
						'slug' => 'tightend',
					),
					array(
						'name' => 'Defensive Lineman',
						'slug' => 'defensivelineman',
					),
					array(
						'name' => 'Linebacker',
						'slug' => 'linebacker',
					),
					array(
						'name' => 'Defensive Back',
						'slug' => 'defensiveback',
					),
					array(
						'name' => 'Kickoff Kicker',
						'slug' => 'kickoffkicker',
					),
					array(
						'name' => 'Kick Returner',
						'slug' => 'kickreturner',
					),
					array(
						'name' => 'Punter',
						'slug' => 'punter',
					),
					array(
						'name' => 'Punt Returner',
						'slug' => 'puntreturner',
					),
					array(
						'name' => 'Field Goal Kicker',
						'slug' => 'fieldgoalkicker',
					),
				),
			),
			'stats_labels' => array(
				'pa_cmp' => '<a title="' . __('Pass Completions', 'wp-club-manager'). '">' . __('CMP', 'wp-club-manager') . '</a>',
				'pa_yds' => '<a title="' . __('Passing Yards', 'wp-club-manager'). '">' . __('YDS', 'wp-club-manager') . '</a>',
				'sc_pass' => '<a title="' . __('Passing Touchdowns', 'wp-club-manager'). '">' . __('PASS', 'wp-club-manager') . '</a>',
				'pa_int' => '<a title="' . __('Passing Interceptions', 'wp-club-manager'). '">' . __('INT', 'wp-club-manager') . '</a>',
				'ru_yds' => '<a title="' . __('Rushing Yards', 'wp-club-manager'). '">' . __('YDS', 'wp-club-manager') . '</a>',
				'sc_rush' => '<a title="' . __('Rushing Touchdowns', 'wp-club-manager'). '">' . __('RUSH', 'wp-club-manager') . '</a>',
				're_rec' => '<a title="' . __('Receptions', 'wp-club-manager'). '">' . __('REC', 'wp-club-manager') . '</a>',
				're_yds' => '<a title="' . __('Receiving Yards', 'wp-club-manager'). '">' . __('YDS', 'wp-club-manager') . '</a>',
				'sc_rec' => '<a title="' . __('Receiving Touchdowns', 'wp-club-manager'). '">' . __('REC', 'wp-club-manager') . '</a>',
				'de_total' => '<a title="' . __('Total Tackles', 'wp-club-manager'). '">' . __('TOTAL', 'wp-club-manager') . '</a>',
				'de_sack' => '<a title="' . __('Sacks', 'wp-club-manager'). '">' . __('SACK', 'wp-club-manager') . '</a>',
				'de_ff' => '<a title="' . __('Fumbles', 'wp-club-manager'). '">' . __('FF', 'wp-club-manager') . '</a>',
				'de_int' => '<a title="' . __('Interceptions', 'wp-club-manager'). '">' . __('INT', 'wp-club-manager') . '</a>',
				'de_kb' => '<a title="' . __('Blocked Kicks', 'wp-club-manager'). '">' . __('KB', 'wp-club-manager') . '</a>',
				'sc_td' => '<a title="' . __('Touchdowns', 'wp-club-manager'). '">' . __('TD', 'wp-club-manager') . '</a>',
				'sc_2pt' => '<a title="' . __('2 Point Conversions', 'wp-club-manager'). '">' . __('2PT', 'wp-club-manager') . '</a>',
				'sc_fg' => '<a title="' . __('Field Goals', 'wp-club-manager'). '">' . __('FG', 'wp-club-manager') . '</a>',
				'sc_pat' => '<a title="' . __('Extra Points', 'wp-club-manager'). '">' . __('PAT', 'wp-club-manager') . '</a>',
				'sc_pts' => '<a title="' . __('Total Points', 'wp-club-manager'). '">' . __('PTS', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'footy' => array(
			'name' => __( 'Australian Rules Football', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Full Back',
						'slug' => 'full-back',
					),
					array(
						'name' => 'Back Pocket',
						'slug' => 'back-pocket',
					),
					array(
						'name' => 'Centre Half-Back',
						'slug' => 'centre-half-back',
					),
					array(
						'name' => 'Half-Back Flank',
						'slug' => 'half-back-flank',
					),
					array(
						'name' => 'Centre Half-Forward',
						'slug' => 'centre-half-forward',
					),
					array(
						'name' => 'Half-Forward Flank',
						'slug' => 'half-forward-flank',
					),
					array(
						'name' => 'Full Forward',
						'slug' => 'full-forward',
					),
					array(
						'name' => 'Forward Pocket',
						'slug' => 'forward-pocket',
					),
					array(
						'name' => 'Follower',
						'slug' => 'follower',
					),
					array(
						'name' => 'Inside Midfield',
						'slug' => 'inside-midfield',
					),
					array(
						'name' => 'Outside Midfield',
						'slug' => 'outside-midfield',
					),
				),
			),
			'stats_labels' => array(
				'k' => '<a title="' . __('Kicks', 'wp-club-manager'). '">' . __('K', 'wp-club-manager') . '</a>',
				'hb' => '<a title="' . __('Handballs', 'wp-club-manager'). '">' . __('HB', 'wp-club-manager') . '</a>',
				'd' => '<a title="' . __('Disposals', 'wp-club-manager'). '">' . __('D', 'wp-club-manager') . '</a>',
				'cp' => '<a title="' . __('Contested Possesion', 'wp-club-manager'). '">' . __('CP', 'wp-club-manager') . '</a>',
				'm' => '<a title="' . __('Marks', 'wp-club-manager'). '">' . __('M', 'wp-club-manager') . '</a>',
				'cm' => '<a title="' . __('Contested Marks', 'wp-club-manager'). '">' . __('CM', 'wp-club-manager') . '</a>',
				'ff' => '<a title="' . __('Frees For', 'wp-club-manager'). '">' . __('FF', 'wp-club-manager') . '</a>',
				'fa' => '<a title="' . __('Frees Against', 'wp-club-manager'). '">' . __('FA', 'wp-club-manager') . '</a>',
				'clg' => '<a title="' . __('Clangers', 'wp-club-manager'). '">' . __('C', 'wp-club-manager') . '</a>',
				'tkl' => '<a title="' . __('Tackles', 'wp-club-manager'). '">' . __('T', 'wp-club-manager') . '</a>',
				'i50' => '<a title="' . __('Inside 50s', 'wp-club-manager'). '">' . __('I50', 'wp-club-manager') . '</a>',
				'r50' => '<a title="' . __('Rebound 50s', 'wp-club-manager'). '">' . __('R50', 'wp-club-manager') . '</a>',
				'1pct' => '<a title="' . __('One-Percenters', 'wp-club-manager'). '">' . __('1PCT', 'wp-club-manager') . '</a>',
				'ho' => '<a title="' . __('Hit-Outs', 'wp-club-manager'). '">' . __('HO', 'wp-club-manager') . '</a>',
				'g' => '<a title="' . __('Goals', 'wp-club-manager'). '">' . __('G', 'wp-club-manager') . '</a>',
				'b' => '<a title="' . __('Behinds', 'wp-club-manager'). '">' . __('B', 'wp-club-manager') . '</a>',
				'yellowpcmards' => '<a title="' . __('Yellow Cards', 'wp-club-manager'). '">' . __('YC', 'wp-club-manager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wp-club-manager'). '">' . __('RC', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'gaelic' => array(
			'name' => __( 'Gaelic Football / Hurling', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalkeeper',
						'slug' => 'goalkeeper',
					),
					array(
						'name' => 'Defender',
						'slug' => 'defender',
					),
					array(
						'name' => 'Midfielder',
						'slug' => 'midfielder',
					),
					array(
						'name' => 'Forward',
						'slug' => 'forward',
					),
				),
			),
			'stats_labels' => array(
				'g' => '<a title="' . __('Goals', 'wp-club-manager'). '">' . __('G', 'wp-club-manager') . '</a>',
				'pts' => '<a title="' . __('Points', 'wp-club-manager'). '">' . __('P', 'wp-club-manager') . '</a>',
				'gff' => '<a title="' . __('Goals from Frees', 'wp-club-manager'). '">' . __('GFF', 'wp-club-manager') . '</a>',
				'sog' => '<a title="' . __('Points from Frees', 'wp-club-manager'). '">' . __('PFF', 'wp-club-manager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wp-club-manager'). '">' . __('YC', 'wp-club-manager') . '</a>',
				'blackcards' => '<a title="' . __('Black Cards', 'wp-club-manager'). '">' . __('BC', 'wp-club-manager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wp-club-manager'). '">' . __('RC', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'handball' => array(
			'name' => __( 'Handball', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalkeeper',
						'slug' => 'goalkeeper',
					),
					array(
						'name' => 'Left Wing',
						'slug' => 'left-wing',
					),
					array(
						'name' => 'Left Back',
						'slug' => 'left-back',
					),
					array(
						'name' => 'Center',
						'slug' => 'center',
					),
					array(
						'name' => 'Right Wing',
						'slug' => 'right-wing',
					),
					array(
						'name' => 'Right Back',
						'slug' => 'right-back',
					),
					array(
						'name' => 'Pivot',
						'slug' => 'pivot',
					),
				),
			),
			'stats_labels' => array(
				'goals' => '<a title="' . __('Goals', 'wp-club-manager'). '">' . __('GLS', 'wp-club-manager') . '</a>',
				'2min' => '<a title="' . __('2 Minute Suspension', 'wp-club-manager'). '">' . __('2MIN', 'wp-club-manager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wp-club-manager'). '">' . __('YC', 'wp-club-manager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wp-club-manager'). '">' . __('RC', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'hockey_field' => array(
			'name' => __( 'Field Hockey', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalie',
						'slug' => 'goalie',
					),
					array(
						'name' => 'Defence',
						'slug' => 'defence',
					),
					array(
						'name' => 'Midfield',
						'slug' => 'midfield',
					),
					array(
						'name' => 'Forward',
						'slug' => 'forward',
					),
				),
			),
			'stats_labels' => array(
				'gls' => '<a title="' . __('Goals', 'wp-club-manager'). '">' . __('G', 'wp-club-manager') . '</a>',
				'ass' => '<a title="' . __('Assists', 'wp-club-manager'). '">' . __('A', 'wp-club-manager') . '</a>',
				'sho' => '<a title="' . __('Shots', 'wp-club-manager'). '">' . __('SH', 'wp-club-manager') . '</a>',
				'sog' => '<a title="' . __('Shots on Goal', 'wp-club-manager'). '">' . __('SOG', 'wp-club-manager') . '</a>',
				'sav' => '<a title="' . __('Saves', 'wp-club-manager'). '">' . __('SAV', 'wp-club-manager') . '</a>',
				'greencards' => '<a title="' . __('Green Cards', 'wp-club-manager'). '">' . __('GC', 'wp-club-manager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wp-club-manager'). '">' . __('YC', 'wp-club-manager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wp-club-manager'). '">' . __('RC', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'hockey' => array(
			'name' => __( 'Ice Hockey', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalie',
						'slug' => 'goalie',
					),
					array(
						'name' => 'Defense',
						'slug' => 'defense',
					),
					array(
						'name' => 'Center',
						'slug' => 'center',
					),
					array(
						'name' => 'Right Wing',
						'slug' => 'right-wing',
					),
					array(
						'name' => 'Left Wing',
						'slug' => 'left-wing',
					),
				),
			),
			'stats_labels' => array(
				'g' => '<a title="' . __('Goals', 'wp-club-manager'). '">' . __('G', 'wp-club-manager') . '</a>',
				'a' => '<a title="' . __('Assists', 'wp-club-manager'). '">' . __('A', 'wp-club-manager') . '</a>',
				'plusminus' => '<a title="' . __('Plus/Minus Rating', 'wp-club-manager'). '">' . __('+/-', 'wp-club-manager') . '</a>',
				'sog' => '<a title="' . __('Shots on Goal', 'wp-club-manager'). '">' . __('SOG', 'wp-club-manager') . '</a>',
				'ms' => '<a title="' . __('Missed Shots', 'wp-club-manager'). '">' . __('MS', 'wp-club-manager') . '</a>',
				'bs' => '<a title="' . __('Blocked Shots', 'wp-club-manager'). '">' . __('BS', 'wp-club-manager') . '</a>',
				'pim' => '<a title="' . __('Penalty Minutes', 'wp-club-manager'). '">' . __('PIM', 'wp-club-manager') . '</a>',
				'ht' => '<a title="' . __('Hits', 'wp-club-manager'). '">' . __('HT', 'wp-club-manager') . '</a>',
				'fw' => '<a title="' . __('Faceoffs Won', 'wp-club-manager'). '">' . __('FW', 'wp-club-manager') . '</a>',
				'fl' => '<a title="' . __('Faceoffs Lost', 'wp-club-manager'). '">' . __('FL', 'wp-club-manager') . '</a>',
				'sav' => '<a title="' . __('Saves', 'wp-club-manager'). '">' . __('SAV', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'netball' => array(
			'name' => __( 'Netball', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goal Shooter',
						'slug' => 'goal-shooter',
					),
					array(
						'name' => 'Goal Attack',
						'slug' => 'goal-attack',
					),
					array(
						'name' => 'Wing Attack',
						'slug' => 'wing-attack',
					),
					array(
						'name' => 'Centre',
						'slug' => 'centre',
					),
					array(
						'name' => 'Wing Defence',
						'slug' => 'wing-defence',
					),
					array(
						'name' => 'Goal Defence',
						'slug' => 'goal-defence',
					),
					array(
						'name' => 'Goal Keeper',
						'slug' => 'goal-keeper',
					),
				),
			),
			'stats_labels' => array(
				'g' => '<a title="' . __('Goals', 'wp-club-manager'). '">' . __('GLS', 'wp-club-manager') . '</a>',
				'gatt' => '<a title="' . __('Goal Attempts', 'wp-club-manager'). '">' . __('ATT', 'wp-club-manager') . '</a>',
				'gass' => '<a title="' . __('Goal Assists', 'wp-club-manager'). '">' . __('AST', 'wp-club-manager') . '</a>',
				'rbs' => '<a title="' . __('Rebounds', 'wp-club-manager'). '">' . __('REB', 'wp-club-manager') . '</a>',
				'cpr' => '<a title="' . __('Centre Pass Receives', 'wp-club-manager'). '">' . __('CPR', 'wp-club-manager') . '</a>',
				'int' => '<a title="' . __('Interceptions', 'wp-club-manager'). '">' . __('INT', 'wp-club-manager') . '</a>',
				'def' => '<a title="' . __('Deflections', 'wp-club-manager'). '">' . __('DEF', 'wp-club-manager') . '</a>',
				'pen' => '<a title="' . __('Penaties', 'wp-club-manager'). '">' . __('PEN', 'wp-club-manager') . '</a>',
				'to' => '<a title="' . __('Turnovers', 'wp-club-manager'). '">' . __('TO', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'rugby' => array(
			'name' => __( 'Rugby', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Scrum Half',
						'slug' => 'scrum-half',
					),
					array(
						'name' => 'Fly Half',
						'slug' => 'fly-half',
					),
					array(
						'name' => 'Centre',
						'slug' => 'centre',
					),
					array(
						'name' => 'Winger',
						'slug' => 'winger',
					),
					array(
						'name' => 'Full Back',
						'slug' => 'full-back',
					),
					array(
						'name' => 'Prop',
						'slug' => 'prop',
					),
					array(
						'name' => 'Hooker',
						'slug' => 'hooker',
					),
					array(
						'name' => 'Lock',
						'slug' => 'lock',
					),
					array(
						'name' => 'Flanker',
						'slug' => 'flanker',
					),
					array(
						'name' => 'No. 8',
						'slug' => 'no-8',
					),
				),
			),
			'stats_labels' => array(
				't' => '<a title="' . __('Tries', 'wp-club-manager'). '">' . __('TRI', 'wp-club-manager') . '</a>',
				'c' => '<a title="' . __('Conversions', 'wp-club-manager'). '">' . __('CON', 'wp-club-manager') . '</a>',
				'p' => '<a title="' . __('Penalties', 'wp-club-manager'). '">' . __('PEN', 'wp-club-manager') . '</a>',
				'dg' => '<a title="' . __('Drop Goals', 'wp-club-manager'). '">' . __('DG', 'wp-club-manager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wp-club-manager'). '">' . __('YC', 'wp-club-manager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wp-club-manager'). '">' . __('RC', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager') . '</a>',
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'soccer' => array(
			'name' => __( 'Football (Soccer)', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Goalkeeper',
						'slug' => 'goalkeeper',
					),
					array(
						'name' => 'Defender',
						'slug' => 'defender',
					),
					array(
						'name' => 'Midfielder',
						'slug' => 'midfielder',
					),
					array(
						'name' => 'Forward',
						'slug' => 'forward',
					),
				),
			),
			'stats_labels' => array(
				'goals' => '<a title="' . __('Goals', 'wp-club-manager'). '">' . __('GLS', 'wp-club-manager') . '</a>',
				'assists' => '<a title="' . __('Assists', 'wp-club-manager'). '">' . __('AST', 'wp-club-manager') . '</a>',
				'penalties' => '<a title="' . __('Penalty Goals', 'wp-club-manager'). '">' . __('PENS', 'wp-club-manager') . '</a>',
				'og' => '<a title="' . __('Own Goals', 'wp-club-manager'). '">' . __('OG', 'wp-club-manager') . '</a>',
				'cs' => '<a title="' . __('Clean Sheets', 'wp-club-manager'). '">' . __('CS', 'wp-club-manager') . '</a>',
				'yellowcards' => '<a title="' . __('Yellow Cards', 'wp-club-manager'). '">' . __('YC', 'wp-club-manager') . '</a>',
				'redcards' => '<a title="' . __('Red Cards', 'wp-club-manager'). '">' . __('RC', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
		'volleyball' => array(
			'name' => __( 'Volleyball', 'wp-club-manager' ),
			'terms' => array(
				// Positions
				'wpcm_position' => array(
					array(
						'name' => 'Outside Hitter',
						'slug' => 'outside-hitter',
					),
					array(
						'name' => 'Middle Blocker',
						'slug' => 'middle-blocker',
					),
					array(
						'name' => 'Setter',
						'slug' => 'setter',
					),
					array(
						'name' => 'Opposite',
						'slug' => 'opposite',
					),
					array(
						'name' => 'Defensive Specialist',
						'slug' => 'defensive-specialist',
					),
					array(
						'name' => 'Libero',
						'slug' => 'libero',
					),
				),
			),
			'stats_labels' => array(
				'ace' => '<a title="' . __('Aces', 'wp-club-manager'). '">' . __('ACE', 'wp-club-manager') . '</a>',
				'kill' => '<a title="' . __('Kills', 'wp-club-manager'). '">' . __('KILL', 'wp-club-manager') . '</a>',
				'blk' => '<a title="' . __('Blocks', 'wp-club-manager'). '">' . __('BLK', 'wp-club-manager') . '</a>',
				'bass' => '<a title="' . __('Block Assists', 'wp-club-manager'). '">' . __('BA', 'wp-club-manager') . '</a>',
				'sass' => '<a title="' . __('Setting Assists', 'wp-club-manager'). '">' . __('SA', 'wp-club-manager') . '</a>',
				'dig' => '<a title="' . __('Digs', 'wp-club-manager'). '">' . __('DIG', 'wp-club-manager') . '</a>',
				'rating' => '<a title="' . __('Rating', 'wp-club-manager'). '">' . __('RAT', 'wp-club-manager'),
				'mvp' => '<a title="' . __('Player of Match', 'wp-club-manager'). '">' . __('POM', 'wp-club-manager') . '</a>',
			),
		),
	));
}

function wpcm_get_sport_options() {
	$sports = wpcm_get_sport_presets();
	$options = array();
	foreach ( $sports as $slug => $data ):
		$options[ $slug ] = $data['name'];
	endforeach;
	return $options;
}

function wpcm_get_sports_stats_labels() {
	$sport = get_option('wpcm_sport');

	$data = wpcm_get_sport_presets();

	$wpcm_player_stats_labels = $data[$sport]['stats_labels'];

	return $wpcm_player_stats_labels;
}