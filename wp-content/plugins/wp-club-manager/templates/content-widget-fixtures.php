<?php
/**
 * Fixtures Widget
 *
 * @author 		Clubpress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

global $post;

$postid = get_the_ID();
$format = get_match_title_format();
$home_club = get_post_meta( $postid, 'wpcm_home_club', true );
$away_club = get_post_meta( $postid, 'wpcm_away_club', true );
$comps = get_the_terms( $postid, 'wpcm_comp' );
$comp_status = get_post_meta( $postid, 'wpcm_comp_status', true );
$seasons = get_the_terms( $postid, 'wpcm_season' );
$teams = get_the_terms( $postid, 'wpcm_team' );
if( $format == '%home% vs %away%' ) :
	$side1 = $home_club;
	$side2 = $away_club;
else :
	$side1 = $away_club;
	$side2 = $home_club;
endif;
if( has_post_thumbnail( $side1 ) ) :
	$crest1 = get_the_post_thumbnail( $side1, 'crest-medium', array( 'title' => wpcm_get_team_name( $side1, $postid ) ) );
else :
	$crest1 = wpcm_crest_placeholder_img( 'crest-medium' );
endif;
if( has_post_thumbnail( $side2 ) ) :
	$crest2 = get_the_post_thumbnail( $side2, 'crest-medium', array( 'title' => wpcm_get_team_name( $side2, $postid ) ) );
else :
	$crest2 = wpcm_crest_placeholder_img( 'crest-medium' );
endif;
			
echo '<li class="fixture">';

	echo '<div class="fixture-meta">';

		if ( $show_team && is_array( $teams ) ):
			echo '<div class="team">';
			foreach ( $teams as $team ):
				echo '<span>' . $team->name . '</span>';
			endforeach;
			echo '</div>';
		endif;
		if ( $show_comp && is_array( $comps ) ):
			echo '<div class="competition">';
			foreach ( $comps as $comp ):
				echo '<span>' . $comp->name . '&nbsp;' . $comp_status . '</span>';
			endforeach;
			echo '</div>';
		endif;

	echo '</div>';

	echo '<a href="' . get_post_permalink( $postid, false, true ) . '">';

		echo '<div class="clubs">';
			echo '<h4 class="home-clubs">';
				echo '<div class="home-logo">' . $crest1 . '</div>';
				echo wpcm_get_team_name( $side1, $postid );
			echo '</h4>';
			echo '<h4 class="away-clubs">';
				echo '<div class="away-logo">' . $crest2 . '</div>';
				echo wpcm_get_team_name( $side2, $postid );
			echo '</h4>';
		echo '</div>';
	echo '</a>';

	echo '<div class="wpcm-date">';
		echo '<div class="kickoff">';
			if ( $show_date ) {
				echo the_time('j M Y');
			}
			if ( $show_time ) {
				echo ' - ';
				echo the_time('g:i a');
			}
		echo '</div>';			
	echo '</div>';

echo '</li>';