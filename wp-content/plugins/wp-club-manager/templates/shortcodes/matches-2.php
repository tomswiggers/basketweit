<?php
/**
 * Matches - New matches shortcode layout
 *
 * @author 		Clubpress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<li class="wpcm-matches-list-item <?php echo $class; ?>">
	
	<a href="<?php echo $match_link; ?>" class="wpcm-matches-list-link">
				
		<span class="wpcm-matches-list-col wpcm-matches-list-date">
			<?php echo date_i18n( 'D d M', $timestamp ); ?>
		</span>

		<span class="wpcm-matches-list-col wpcm-matches-list-club1">
			<?php echo $side1; ?>
		</span>

		<span class="wpcm-matches-list-col wpcm-matches-list-status">
			<span class="wpcm-matches-list-<?php echo $status_class; ?> <?php echo $class; ?>">
				<?php echo $status; ?>
			</span>
		</span>

		<span class="wpcm-matches-list-col wpcm-matches-list-club2">
			<?php echo $side2; ?>
		</span>

		<span class="wpcm-matches-list-col wpcm-matches-list-info">
			<?php echo $competition; ?>
		</span>

	</a>

</li>