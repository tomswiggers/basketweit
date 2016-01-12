<?php
/**
 * Single Match - Away Club
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpclubmanager, $post;

$format = get_match_title_format();
$home_club = get_post_meta( $post->ID, 'wpcm_home_club', true );
$away_club = get_post_meta( $post->ID, 'wpcm_away_club', true );
if( $format == '%home% vs %away%') :
	$side2 = wpcm_get_team_name( $away_club, $post->ID );
else :
	$side2 = wpcm_get_team_name( $home_club, $post->ID );
endif; ?>

<div class="wpcm-match-away-club">

	<?php echo $side2; ?>

</div>