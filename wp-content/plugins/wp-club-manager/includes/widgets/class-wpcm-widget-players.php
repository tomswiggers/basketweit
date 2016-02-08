<?php
/**
 * Players Widget
 *
 * @author 		ClubPress
 * @category 	Widgets
 * @package 	WPClubManager/Widgets
 * @version 	1.3.3
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Players_Widget extends WPCM_Widget {	

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass = 'wpcm-widget widget-players';
		$this->widget_description = __( 'Display a table of players details.', 'wp-club-manager' );
		$this->widget_idbase = 'wpcm-players-widget';
		$this->widget_name = __( 'WPCM Players', 'wp-club-manager' );
		$this->settings           = array();

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->widget_cssclass, 'description' => $this->widget_description );

		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {

		extract( $args );

		$title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );	
		$options_string = '';
		
		foreach( $instance as $key => $value ) {
			
			if ( $value != -1 )
				$options_string .= ' ' . $key . '="' . $value . '"';
		}

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		echo '<div class="clearfix">';

		echo do_shortcode('[wpcm_players' . $options_string . ']');

		echo '</div>';

		echo $after_widget;
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		foreach( $new_instance as $key => $value ) {
			
			if ( is_array( $value ) )
				$value = implode(',', $value);
			
			$instance[$key] = strip_tags( $value );
		}
			
		return $instance;
	}
		
	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		
		$defaults = array(
			'limit' => 10,
			'season' => null,
			'team' => null,
			'position' => null,
			'orderby' => 'number',
			'order' => 'ASC',
			'linktext' => __( 'View all players', 'wp-club-manager' ),
			'linkpage' => null,
			'stats' => 'flag,number,name,position,age',
			'title' => __( 'Players', 'wp-club-manager' )
		);

		$sport = get_option('wpcm_sport');

		$data = wpcm_get_sport_presets();
		$wpcm_player_stats_labels = $data[$sport]['stats_labels'];

		$player_stats_labels = array_merge( array( 'appearances' => __( 'Appearances', 'wp-club-manager' ), 'subs' => __( 'Sub Appearances', 'wp-club-manager' ) ), $wpcm_player_stats_labels );
		$stats_labels = array_merge(
			array(
				'thumb' => __( 'Image', 'wp-club-manager' ),
				'flag' => __( 'Flag', 'wp-club-manager' ),
				'number' => __( 'Number', 'wp-club-manager' ),
				'name' => __( 'Name', 'wp-club-manager' ),
				'position' => __( 'Position', 'wp-club-manager' ),
				'age' => __( 'Age', 'wp-club-manager' ),
				'height' => __( 'Height', 'wp-club-manager' ),
				'weight' => __( 'Weight', 'wp-club-manager' ),
				'team' => __( 'Team', 'wp-club-manager' ),
				'season' => __( 'Season', 'wp-club-manager' ),
				'dob' => __( 'Date of Birth', 'wp-club-manager' ),
				'hometown' => __( 'Hometown', 'wp-club-manager' ),
				'joined' => __( 'Joined', 'wp-club-manager' )
			),
			$player_stats_labels
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		$stats = explode( ',', $instance['stats'] );
		?>
		
		<?php $field = 'title'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Title', 'wp-club-manager') ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" value="<?php echo $instance[$field]; ?>" type="text" />
		</p>
		
		<?php $field = 'limit'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Limit', 'wp-club-manager') ?>:</label>
			<input id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" value="<?php echo $instance[$field]; ?>" type="number" size="3" />
		</p>
		
		<?php $field = 'season'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Season', 'wp-club-manager') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'hide_empty' => 0,
				'orderby' => 'title',
				'taxonomy' => 'wpcm_season',
				'selected' => $instance[$field],
				'name' => $this->get_field_name( $field ),
				'id' => $this->get_field_id( $field )
			));
			?>
		</p>
		
		<?php $field = 'team'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Team', 'wp-club-manager') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'hide_empty' => 0,
				'orderby' => 'title',
				'taxonomy' => 'wpcm_team',
				'selected' => $instance[$field],
				'name' => $this->get_field_name( $field ),
				'id' => $this->get_field_id( $field )
			));
			?>
		</p>
		
		<?php $field = 'position'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Position', 'wp-club-manager') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'hide_empty' => 0,
				'orderby' => 'title',
				'taxonomy' => 'wpcm_position',
				'selected' => $instance[$field],
				'name' => $this->get_field_name( $field ),
				'id' => $this->get_field_id( $field )
			));
			?>
		</p>
				
		<?php $field = 'orderby'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Order by', 'wp-club-manager') ?>:</label>
			<select id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>">
				<option id="number" value="number"<?php if ( $instance[$field] == 'number' ) echo ' selected'; ?>><?php _e( 'Number', 'wp-club-manager' ); ?></option>
				<option id="menu_order" value="menu_order"<?php if ( $instance[$field] == 'menu_order' ) echo ' selected'; ?>><?php _e( 'Page order' ); ?></option>
				<?php foreach ( $player_stats_labels as $key => $val ) { ?>

					<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $instance[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>

				<?php } ?>
			</select>
		</p>
			
		<?php $field = 'order'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Order', 'wp-club-manager') ?>:</label>
			<?php
			$wpcm_order_options = array(
				'ASC' => __( 'Lowest to highest', 'wp-club-manager' ),
				'DESC' => __( 'Highest to lowest', 'wp-club-manager' )
			);
			?>
			<select id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>">
				<?php foreach ( $wpcm_order_options as $key => $val ) { ?>

					<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $instance[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>

				<?php } ?>
			</select>
		</p>
			
		<?php $field = 'stats'; ?>
		<p>
			<label><?php _e( 'Statistics', 'wp-club-manager' ); ?></label>
			<table>
				<tr>
					<?php $count = 0;
					foreach ( $stats_labels as $key => $value ) {
						
						$count++;
						if ( $count > 2 ) {
							$count = 1;
							echo '</tr><tr>';
						}
					?>
					<td>
						<label class="selectit" for="<?php echo $this->get_field_id( $field ); ?>-<?php echo $key; ?>">
							<input type="checkbox" id="<?php echo $this->get_field_id( $field ); ?>-<?php echo $key; ?>" name="<?php echo $this->get_field_name( $field ); ?>[]" value="<?php echo $key; ?>" <?php checked( in_array( $key, $stats ) ); ?> />
							<?php echo $value; ?>
						</label>
					</td>
				<?php } ?>
				</tr>
			</table>
		</p>
			
		<?php $field = 'linktext'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Link text', 'wp-club-manager') ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( $field ); ?>" name="<?php echo $this->get_field_name( $field ); ?>" value="<?php echo $instance[$field]; ?>" type="text" />
		</p>
			
		<?php $field = 'linkpage'; ?>
		<p>
			<label for="<?php echo $this->get_field_id( $field ); ?>"><?php _e('Link page', 'wp-club-manager') ?>:</label>
			<?php
			wp_dropdown_pages( array(
				'show_option_none' => __( 'None' ),
				'selected' => $instance[$field],
				'name' => $this->get_field_name( $field ),
				'id' => $this->get_field_id( $field )
			) );
			?>
		</p>

	<?php
	}
}