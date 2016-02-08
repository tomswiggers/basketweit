<?php
/**
 * Single match - Away Badge
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$format = get_match_title_format();
$home_club = get_post_meta( $post->ID, 'wpcm_home_club', true );
$away_club = get_post_meta( $post->ID, 'wpcm_away_club', true );
if( $format == '%home% vs %away%') :
	if( has_post_thumbnail( $away_club ) ) {
		$badge = get_the_post_thumbnail( $away_club, 'crest-medium', array( 'class' => 'away-logo' ) );
	} else {
		$badge = wpcm_crest_placeholder_img( 'crest-medium' );
	}
else :
	if( has_post_thumbnail( $home_club ) ) {
		$badge = get_the_post_thumbnail( $home_club, 'crest-medium', array( 'class' => 'away-logo' ) );
	} else {
		$badge = wpcm_crest_placeholder_img( 'crest-medium' );
	}
endif; ?>

<div class="wpcm-match-away-club-badge">

	<?php echo $badge; ?>

</div>