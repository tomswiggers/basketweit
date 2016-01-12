<?php
/**
 * Single Player - Stats Table
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wpclubmanager;

$teams = get_the_terms( $post->ID, 'wpcm_team' );
$stats = get_wpcm_player_stats( $post );
$seasons = get_the_terms( $post->ID, 'wpcm_season' );
$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();
$stats_labels = array_merge( array( 'appearances' => __( 'Apps', 'wp-club-manager' ) ), $wpcm_player_stats_labels );

if( is_array( $teams ) ) {

	foreach( $teams as $team ) {

		$rand = rand(1,99999);
		$name = $team->name;

		if ( $team->parent ) {
			$parent_team = get_term( $team->parent, 'wpcm_team');
			$name .= ' (' . $parent_team->name . ')';
		} ?>

		<div class="wpcm-profile-stats-block">

			<h4><?php echo $name; ?></h4>

			<ul class="stats-tabs-<?php echo $rand; ?> stats-tabs-multi">
							
				<li class="tabs-multi"><a href="#wpcm_team-0_season-0-<?php echo $rand; ?>"><?php printf( __( 'All %s', 'wp-club-manager' ), __( 'Seasons', 'wp-club-manager' ) ); ?></a></li>

				<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>

					<li><a href="#wpcm_team-<?php echo $team->term_id; ?>_season-<?php echo $season->term_id; ?>"><?php echo $season->name; ?></a></li>

				<?php endforeach; endif; ?>
				
			</ul>

			<div id="wpcm_team-0_season-0-<?php echo $rand; ?>" class="tabs-panel-<?php echo $rand; ?> tabs-panel-multi stats-table-season-<?php echo $rand; ?>">
							
				<?php wpcm_profile_stats_table( $stats, $team->term_id, 0 ); ?>

				
			</div>
						
			<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>
							
				<div id="wpcm_team-<?php echo $team->term_id; ?>_season-<?php echo $season->term_id; ?>" class="tabs-panel-<?php echo $rand; ?> tabs-panel-multi stats-table-season-<?php echo $rand; ?>" style="display: none;">
								
					<?php wpcm_profile_stats_table( $stats, $team->term_id, $season->term_id ); ?>

					
							
				</div>
				
			<?php endforeach; endif; ?>

		</div>
					
		<script type="text/javascript">
			(function($) {
				$('.stats-tabs-<?php echo $rand; ?> a').click(function(){
					var t = $(this).attr('href');
					
					$(this).parent().addClass('tabs-multi <?php echo $rand; ?>').siblings('li').removeClass('tabs-multi <?php echo $rand; ?>');
					$(this).parent().parent().parent().find('.tabs-panel-<?php echo $rand; ?>').hide();
					$(t).show();

					return false;
				});
			})(jQuery);
		</script>

	<?php
	}
} else { ?>

	<ul class="stats-tabs">
				
		<li class="tabs"><a href="#wpcm_team-0_season-0"><?php printf( __( 'All %s', 'wp-club-manager' ), __( 'Seasons', 'wp-club-manager' ) ); ?></a></li>

		<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>

			<li><a href="#wpcm_team-0_season-<?php echo $season->term_id; ?>"><?php echo $season->name; ?></a></li>

		<?php endforeach; endif; ?>
		
	</ul>
				
	<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>
					
		<div id="wpcm_team-0_season-<?php echo $season->term_id; ?>" class="tabs-panel" style="display: none;">
						
			<?php wpcm_profile_stats_table( $stats, 0, $season->term_id ); ?>
					
		</div>
		
	<?php endforeach; endif; ?>
				
	<div id="wpcm_team-0_season-0" class="tabs-panel">
					
		<?php wpcm_profile_stats_table( $stats, 0, 0 ); ?>
				
	</div>

<?php } ?>