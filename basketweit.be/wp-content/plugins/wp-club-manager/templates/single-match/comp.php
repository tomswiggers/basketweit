<?php
/**
 * Single Match - Comp
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpclubmanager, $post;

$post_id = $post->ID;
$match = get_post( $post_id );
$comps = get_the_terms( $match->ID, 'wpcm_comp' );
$comp_status = get_post_meta( $post->ID, 'wpcm_comp_status', true ); ?>

<div class="wpcm-match-comp">

<?php if ( is_array( $comps ) ) { ?>
				
	<?php foreach ( $comps as $comp ) { ?>

	<span>

		<?php echo $comp->name . '&nbsp;' . $comp_status; ?>

	</span>

	<?php }

} ?>

</div>