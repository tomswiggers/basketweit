<?php
/**
 * Single Match - Score
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.3.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpclubmanager, $post;

$sport = get_option( 'wpcm_sport' );
$format = get_match_title_format();
$sep = get_option( 'wpcm_match_goals_delimiter' );
$home_goals = get_post_meta( $post->ID, 'wpcm_home_goals', true );
$away_goals = get_post_meta( $post->ID, 'wpcm_away_goals', true );
$played = get_post_meta( $post->ID, 'wpcm_played', true );
$gaa_goals_home = get_post_meta( $post->ID, 'wpcm_home_gaa_goals', true );
$gaa_points_home = get_post_meta( $post->ID, 'wpcm_home_gaa_points', true );
$gaa_goals_away = get_post_meta( $post->ID, 'wpcm_away_gaa_goals', true );
$gaa_points_away = get_post_meta( $post->ID, 'wpcm_away_gaa_points', true );
if( !$played ) :
	$sep = get_option( 'wpcm_match_clubs_separator' );
else :
	$sep = get_option( 'wpcm_match_goals_delimiter' );
endif;
if( $format == '%home% vs %away%') :
	if ( $sport == 'gaelic' ) {
		$side1 = $gaa_goals_home . '-' . $gaa_points_home;
		$side2 = $gaa_goals_away . '-' . $gaa_points_away;
	} else {
		$side1 = $home_goals;
		$side2 = $away_goals;
	}
else :
	if ( $sport == 'gaelic' ) {
		$side1 = $gaa_goals_away . '-' . $gaa_points_away;
		$side2 = $gaa_goals_home . '-' . $gaa_points_home;
	} else {
		$side1 = $away_goals;
		$side2 = $home_goals;
	}
endif; ?>

<div class="wpcm-match-score">

	<?php
	if ( $played ) {
		if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) {
			echo __('X', 'wp-club-manager' );
		} else {	
			echo $side1;
		}
	}
	?>

	<span class="wpcm-match-score-delimiter"><?php echo $sep ?></span>

	<?php
	if ( $played ) {
		if( get_option( 'wpcm_hide_scores') == 'yes' && ! is_user_logged_in() ) {
			echo __('X', 'wp-club-manager' );
		} else {
			echo $side2;
		}
	}
	?>

</div>