<?php
/**
 * Player Stats
 *
 * Displays the player stats box.
 *
 * @author 		ClubPress
 * @category 	Admin
 * @package 	WPClubManager/Admin/Meta Boxes
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Meta_Box_Player_Stats {

	/**
	 * Output the metabox
	 */
	public static function output( $post ) {

		$teams = get_the_terms( $post->ID, 'wpcm_team' );
		$stats = get_wpcm_player_stats( $post );
		$seasons = get_the_terms( $post->ID, 'wpcm_season' );

		$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();

		$stats_labels = array( 'appearances' => __( 'Apps', 'wp-club-manager' ) );
		$stats_labels = array_merge( $stats_labels, $wpcm_player_stats_labels );

		if( is_array( $teams ) ) { ?>

			<p><?php _e('Choose a team and season to edit the manual stats.', 'wp-club-manager'); ?></p>

			<?php
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

					<div id="wpcm_team-0_season-0-<?php echo $rand; ?>" class="tabs-panel-<?php echo $rand; ?> tabs-panel-multi">
									
						<?php wpcm_player_stats_table( $stats, $team->term_id, 0 ); ?>

						<script type="text/javascript">
							(function($) {
								<?php foreach( $stats_labels as $key => $val ) { ?>

									var sum = 0;
									$('.stats-table-season-<?php echo $rand; ?> .player-stats-manual-<?php echo $key; ?>').each(function(){
										sum += Number($(this).val());
									});
									$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-manual-<?php echo $key; ?>').val(sum);

									var sum = 0;
									$('.stats-table-season-<?php echo $rand; ?> .player-stats-auto-<?php echo $key; ?>').each(function(){
										sum += Number($(this).val());
									});
									$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-auto-<?php echo $key; ?>').val(sum);

									var a = +$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-auto-<?php echo $key; ?>').val();
									var b = +$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-manual-<?php echo $key; ?>').val();
									var total = a+b;
									$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-total-<?php echo $key; ?>').val(total);

								<?php } ?>
							})(jQuery);
						</script>
								
					</div>
							
					<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>
									
						<div id="wpcm_team-<?php echo $team->term_id; ?>_season-<?php echo $season->term_id; ?>" class="tabs-panel-<?php echo $rand; ?> tabs-panel-multi stats-table-season-<?php echo $rand; ?>" style="display: none;">
										
							<?php wpcm_player_stats_table( $stats, $team->term_id, $season->term_id ); ?>

							<script type="text/javascript">
								(function($) {
									<?php foreach( $stats_labels as $key => $val ) { ?>

										var sum = 0;
										$('.stats-table-season-<?php echo $rand; ?> .player-stats-manual-<?php echo $key; ?>').each(function(){
											sum += Number($(this).val());
										});
										$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-manual-<?php echo $key; ?>').val(sum);

										var sum = 0;
										$('.stats-table-season-<?php echo $rand; ?> .player-stats-auto-<?php echo $key; ?>').each(function(){
											sum += Number($(this).val());
										});
										$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-auto-<?php echo $key; ?>').val(sum);

										var a = +$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-auto-<?php echo $key; ?>').val();
										var b = +$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-manual-<?php echo $key; ?>').val();
										var total = a+b;
										$('#wpcm_team-0_season-0-<?php echo $rand; ?> .player-stats-total-<?php echo $key; ?>').val(total);

									<?php } ?>
								})(jQuery);
							</script>
									
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
			<?php }
		} else { ?>

			<div class="statsdiv">
				<ul class="wpcm_stats-tabs">
					<li class="tabs"><a href="#wpcm_team-0_season-0" tabindex="3"><?php printf( __( 'All %s', 'wp-club-manager' ), __( 'Seasons', 'wp-club-manager' ) ); ?></a></li>
					<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>
						<li class="hide-if-no-js22"><a href="#wpcm_team-0_season-<?php echo $season->term_id; ?>" tabindex="3"><?php echo $season->name; ?></a></li>
					<?php endforeach; endif; ?>
				</ul>
				<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>
					<div id="wpcm_team-0_season-<?php echo $season->term_id; ?>" class="tabs-panel stats-table-season" style="display: none;">
						<?php wpcm_player_stats_table( $stats, 0, $season->term_id ); ?>
					</div>
				<?php endforeach; endif; ?>
				<div id="wpcm_team-0_season-0" class="tabs-panel">
					<?php wpcm_player_stats_table( $stats, 0, 0 ); ?>
				</div>
			</div>
			<div class="clear"></div>

		<?php }
	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id, $post ) {

		if( isset( $_POST['wpcm_stats'] ) ) {
			$stats = $_POST['wpcm_stats'];
		} else {
			$stats = array();
		}
		array_walk_recursive( $stats, 'wpcm_array_values_to_int' );
		
		update_post_meta( $post_id, 'wpcm_stats', serialize( $stats ) );
	}
}