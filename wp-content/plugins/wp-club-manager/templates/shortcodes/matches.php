<?php
/**
 * Matches
 *
 * @author 		Clubpress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<tr data-url="<?php echo $match_link; ?>">

	<td class="wpcm-date">
		<a class="wpcm-matches-href" href="<?php echo $match_link; ?>"><?php echo date_i18n( 'd M', $timestamp ); ?>, <?php echo date_i18n( $time_format, $timestamp ); ?></a>
	</td>

	<td class="venue">
		<?php echo $venue; ?>
	</td>

	<?php echo $crest; ?>

	<td class="opponent">
		<?php echo $opponent; ?>
	</td>

	<td class="competition">
		<?php echo $competition; ?>
	</td>

	<td class="result <?php echo $class; ?>">
		<?php echo $result; ?>
	</td>

</tr>

