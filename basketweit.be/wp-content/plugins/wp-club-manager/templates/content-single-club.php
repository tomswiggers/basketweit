<?php
/**
 * The template for displaying product content in the single-club.php template
 *
 * Override this template by copying it to yourtheme/wpclubmanager/content-single-club.php
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$address = '';
$cap = '';

$venues = get_the_terms( $post->ID, 'wpcm_venue' );

if ( is_array( $venues ) ) {
	$venue = reset($venues);
	$t_id = $venue->term_id;
	$venue_meta = get_option( "taxonomy_term_$t_id" );
	if( is_array( $venue_meta ) ) {
		if( array_key_exists('wpcm_address', $venue_meta) ) {
			$address = $venue_meta['wpcm_address'];
		}
		if( array_key_exists('wpcm_capacity', $venue_meta) ) {
			$cap = $venue_meta['wpcm_capacity'];
		}
	}
}

do_action( 'wpclubmanager_before_single_club' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wpcm-club-details wpcm-row">

		<h2 class="entry-title">
			<span>
				<?php
				if ( has_post_thumbnail() ) {			
					the_post_thumbnail( 'crest-medium' );
				} else {			
					apply_filters( 'wpclubmanager_club_image', sprintf( '<img src="%s" alt="Placeholder" />', wpcm_placeholder_img_src() ), $post->ID );		
				} ?>
			</span>
			<?php the_title(); ?>
		</h2>

		<table>
			<tbody>
				<tr>
					<th><?php _e('Ground', 'wp-club-manager'); ?></th>
					<td><?php echo $venue->name; ?></td>
				</tr>

				<?php
				if ( $cap ) { ?>
					<tr class="capacity">
						<th><?php _e('Capacity', 'wp-club-manager'); ?></th>
						<td><?php echo $cap; ?></td>
					</tr>
				<?php
				}

				if ( $address ) { ?>
					<tr class="address">
						<th><?php _e('Address', 'wp-club-manager'); ?></th>
						<td><?php echo stripslashes( nl2br( $address ) );?></td>
					</tr>
				<?php
				}

				if ( $venue->description ) { ?>
					<tr class="description">
						<th><?php _e('More Info', 'wp-club-manager'); ?></th>
						<td><?php echo stripslashes( nl2br( $venue->description ) ); ?></td>
					</tr>
				<?php
				} ?>
			</tbody>
		</table>

		<?php do_action( 'wpclubmanager_after_single_club_details' ); ?>

	</div>

	<?php if( $address ) { ?>

		<div class="wpcm-club-map">

			<?php echo do_shortcode( '[wpcm_map address="' . $address . '" width="100%" height="260" marker="1"]' ); ?>

		</div>

	<?php } ?>

	<h3><?php printf( __( 'Matches against %s', 'wp-club-manager'), $post->post_title ); ?></h3>

	<?php wpcm_head_to_heads( $post->ID );

	if ( get_the_content() ) : ?>

		<div class="wpcm-entry-content">

			<?php the_content(); ?>

		</div>

	<?php endif; ?>

	<?php do_action( 'wpclubmanager_after_single_club_content' ); ?>

</article>

<?php do_action( 'wpclubmanager_after_single_club' ); ?>