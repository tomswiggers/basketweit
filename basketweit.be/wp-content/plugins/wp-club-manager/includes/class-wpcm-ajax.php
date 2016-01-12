<?php
/**
 * WPClubManager WPCM_AJAX
 *
 * AJAX Event Handler
 *
 * @class 		WPCM_AJAX
 * @version		1.3.3
 * @package		WPClubManager/Classes
 * @category	Class
 * @author 		ClubPress
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_AJAX {

	/**
	 * Hook into ajax events
	 */
	public function __construct() {

		add_action( 'wp_ajax_wpcm_map_shortcode', array( $this, 'map_shortcode_ajax' ) );
		add_action( 'wp_ajax_wpcm_matches_shortcode', array( $this, 'matches_shortcode_ajax' ) );
		add_action( 'wp_ajax_wpcm_players_shortcode', array( $this, 'players_shortcode_ajax' ) );
		add_action( 'wp_ajax_wpcm_staff_shortcode', array( $this, 'staff_shortcode_ajax' ) );
		add_action( 'wp_ajax_wpcm_standings_shortcode', array( $this, 'standings_shortcode_ajax' ) );
		add_action( 'wp_ajax_wpclubmanager_rated', array( $this, 'rated' ) );
	}

	/**
	 * Triggered when clicking the rating footer.
	 */
	public static function rated() {
		if ( ! current_user_can( 'manage_wpclubmanager' ) ) {
			die(-1);
		}

		update_option( 'wpclubmanager_admin_footer_text_rated', 1 );
		die();
	}

	/**
	* wpcm_map_shortcode_ajax function.
	*/
	public function map_shortcode_ajax() {
		$defaults = array(
			'width' => '584',
			'height' => '320',
			'address' => false,
			'lat' => false,
			'lng' => false,
			'zoom' => '13',
			'marker' => 1
		);
		$args = array_merge( $defaults, $_GET );
		?>
			<div id="wpcm_map-form">
				<table id="wpcm_map-table" class="form-table">
					<tr>
						<?php $field = 'address'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Address', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" class="widefat" /></td>
					</tr>
					<tr>
						<?php $field = 'lat'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Latitude', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" size="3" /></td>
					</tr>
					<tr>
						<?php $field = 'lng'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Longtitude', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" size="3" /></td>
					</tr>
					<tr>
						<?php $field = 'width'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Width', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" size="3" />px</td>
					</tr>
					<tr>
						<?php $field = 'height'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Height', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" size="3" />px</td>
					</tr>
					<tr>
						<?php $field = 'zoom'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Zoom', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" size="3" /></td>
					</tr>
					<tr>
						<?php $field = 'marker'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Display Marker', 'wp-club-manager' ); ?></label></th>
						<td><input type="checkbox" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" checked /></td>
					</tr>
				</table>
				<p class="submit">
					<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'wp-club-manager' ), __( 'Map', 'wp-club-manager' ) ); ?>" name="submit" />
				</p>
			</div>
		<?php
		exit();
	}

	/**
	* wpcm_matches_shortcode_ajax function.
	*/
	public function matches_shortcode_ajax() {

		$defaults = array(
			'type' => '1',
			'comp' => null,
			'season' => null,
			'team' => null,
			'month' => null,
			'venue' => null,
			'linktext' => __( 'View all results', 'wp-club-manager' ),
			'linkpage' => null,
			'title' => __( 'Fixtures & Results', 'wp-club-manager' ),
			'thumb' => 1,
			'link_club' => 1,
		);
		$args = array_merge( $defaults, $_GET );

		$months = array(
			'1' => __( 'January', 'wp-club-manager' ),
			'2' => __( 'February', 'wp-club-manager' ),
			'3' => __( 'March', 'wp-club-manager' ),
			'4' => __( 'April', 'wp-club-manager' ),
			'5' => __( 'May', 'wp-club-manager' ),
			'6' => __( 'June', 'wp-club-manager' ),
			'7' => __( 'July', 'wp-club-manager' ),
			'8' => __( 'August', 'wp-club-manager' ),
			'9' => __( 'September', 'wp-club-manager' ),
			'10' => __( 'October', 'wp-club-manager' ),
			'11' => __( 'November', 'wp-club-manager' ),
			'12' => __( 'December', 'wp-club-manager' )
		);
		?>
			<div id="wpcm_matches-form">
				<table id="wpcm_matches-table" class="form-table">
					<tr>
						<?php $field = 'type'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Type', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							$types = array(
								'1' => __( 'Classic', 'wp-club-manager' ),
								'2' => __( 'List', 'wp-club-manager' )
							);
							?>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<?php foreach ( $types as $key => $val ) { ?>
									<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $args[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'title'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Title', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" class="widefat" /></td>
					</tr>
					<tr>
						<?php $field = 'comp'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Competition', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_comp',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							));
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'season'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Season', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_season',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							));
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'team'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Team', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_team',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							));
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'month'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Month', 'wp-club-manager' ); ?></label></th>
						<td>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<option value="-1"<?php if ( $args[$field] == '-1' ) echo ' selected'; ?>><?php _e( 'All', 'wp-club-manager' ); ?></option>
								<?php foreach ( $months as $key => $val ) { ?>
								<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $args[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'venue'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Venue', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories( array(
								'show_option_none' => __( 'All' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_venue',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'thumb'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Show Thumbnail', 'wp-club-manager' ); ?></label></th>
						<td><input type="checkbox" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" <?php checked( $args[$field], 1 ); ?> /></td>
					</tr>
					<tr>
						<?php $field = 'link_club'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link to Club Page', 'wp-club-manager' ); ?></label></th>
						<td><input type="checkbox" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" <?php checked( $args[$field], 1 ); ?> /></td>
					</tr>
					<tr>
						<?php $field = 'linktext'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link text', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" /></td>
					</tr>
					<tr>
						<?php $field = 'linkpage'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link page', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_pages( array(
								'show_option_none' => __( 'None', 'wp-club-manager' ),
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'wp-club-manager' ), __( 'Fixtures & Results', 'wp-club-manager' ) ); ?>" name="submit" />
				</p>
			</div>
		
		<?php die();
	}

	/**
	* wpcm_club_buttons_ajax function.
	*/
	public function players_shortcode_ajax() {
		$defaults = array(
			'limit' => 0,
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
		$args = array_merge( $defaults, $_GET );
		
		$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();
		
		$player_stats_labels = array_merge( array( 'appearances' => __( 'Appearances', 'wp-club-manager' ), 'subs' => __( 'Sub Appearances', 'wp-club-manager' ) ), $wpcm_player_stats_labels );
		$stats_labels = array_merge(
			array(
				'thumb' => __( 'Thumbnail', 'wp-club-manager' ),
				'flag' => __( 'Flag', 'wp-club-manager' ),
				'number' => __( 'Number', 'wp-club-manager' ),
				'name' => __( 'Name', 'wp-club-manager' ),
				'position' => __( 'Position', 'wp-club-manager' ),
				'age' => __( 'Age', 'wp-club-manager' ),
				'team' => __( 'Team', 'wp-club-manager' ),
				'season' => __( 'Season', 'wp-club-manager' ),
				'dob' => __( 'Date of Birth', 'wp-club-manager' ),
				'height' => __( 'Height', 'wp-club-manager' ),
				'weight' => __( 'Weight', 'wp-club-manager' ),
				'hometown' => __( 'Hometown', 'wp-club-manager' ),
				'joined' => __( 'Joined', 'wp-club-manager' )
			),
			$player_stats_labels
		);
		$stats = explode( ',', $args['stats'] );
		?>
			<div id="wpcm_players-form">
				<table id="wpcm_players-table" class="form-table">
					<tr>
						<?php $field = 'title'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Title', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" class="widefat" /></td>
					</tr>
					<tr>
						<?php $field = 'limit'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Limit', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" size="3" /> (<?php _e( '0 = no limit', 'wp-club-manager' ); ?>)</td>
					</tr>
					<tr>
						<?php $field = 'season'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Season', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_season',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							));
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'team'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Team', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories( array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_team',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'position'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Position', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories( array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_position',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'orderby'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order by', 'wp-club-manager' ); ?></label></th>
						<td>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<option id="number" value="number"<?php if ( $args[$field] == 'number' ) echo ' selected'; ?>><?php _e( 'Number', 'wp-club-manager' ); ?></option>
								<option id="menu_order" value="menu_order"<?php if ( $args[$field] == 'menu_order' ) echo ' selected'; ?>><?php _e( 'Page order' ); ?></option>
								<option id="name" value="name"<?php if ( $args[$field] == 'name' ) echo ' selected'; ?>><?php _e( 'Alphabetical' ); ?></option>
								<?php foreach ( $player_stats_labels as $key => $val ) { ?>
									<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $args[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'order'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							$wpcm_order_options = array(
								'ASC' => __( 'Lowest to highest', 'wp-club-manager' ),
								'DESC' => __( 'Highest to lowest', 'wp-club-manager' )
							);
							?>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<?php foreach ( $wpcm_order_options as $key => $val ) { ?>
									<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $args[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'linktext'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link text', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" /></td>
					</tr>
					<tr>
						<?php $field = 'linkpage'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link page', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_pages( array(
								'show_option_none' => __( 'None', 'wp-club-manager' ),
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'stats'; ?>
						<th><label><?php _e( 'Display options', 'wp-club-manager' ); ?></label></th>
						<td>
							<table>
								<tr>
									<?php
									$count = 0;
									foreach ( $stats_labels as $key => $value ) {
										$count++;
										if ( $count > 3 ) {
											$count = 1;
											echo '</tr><tr>';
										}
									?>
										<td>
											<label class="selectit" for="option-<?php echo $field; ?>-<?php echo $key; ?>">
												<input type="checkbox" id="option-<?php echo $field; ?>-<?php echo $key; ?>" name="<?php echo $field; ?>[]" value="<?php echo $key; ?>" <?php checked( in_array( $key, $stats ) ); ?> />
												<?php echo $value; ?>
											</label>
										</td>
									<?php } ?>
								</tr
							></table>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'wp-club-manager' ), __( 'Players', 'wp-club-manager' ) ); ?>" name="submit" />
				</p>
			</div>
		
		<?php die();
	}

	/**
	* wpcm_staff_shortcode_ajax function.
	*/
	public function staff_shortcode_ajax() {

		$defaults = array(
			'limit' => 0,
			'season' => null,
			'team' => null,
			'jobs' => null,
			'orderby' => 'name',
			'order' => 'ASC',
			'team' => null,
			'linktext' => __( 'View all staff', 'wp-club-manager' ),
			'linkpage' => null,
			'stats' => 'flag,number,name,job,age',
			'title' => __( 'Staff', 'wp-club-manager' ),
		);
		$args = array_merge( $defaults, $_GET );

		$stats_labels = array(
			'thumb' => __( 'Thumbnail', 'wp-club-manager' ),
			'flag' => __( 'Flag', 'wp-club-manager' ),
			'name' => __( 'Name', 'wp-club-manager' ),
			'job' => __( 'Job', 'wp-club-manager' ),
			'email' => __( 'Email', 'wp-club-manager' ),
			'phone' => __( 'Phone', 'wp-club-manager' ),
			'age' => __( 'Age', 'wp-club-manager' ),
			'team' => __( 'Team', 'wp-club-manager' ),
			'season' => __( 'Season', 'wp-club-manager' ),
			'joined' => __( 'Joined', 'wp-club-manager' )
		);
		$stats = explode( ',', $args['stats'] );
		?>
			<div id="wpcm_staff-form">
				<table id="wpcm_staff-table" class="form-table">
					<tr>
						<?php $field = 'title'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Title', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" class="widefat" /></td>
					</tr>
					<tr>
						<?php $field = 'limit'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Limit', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" size="3" /> (<?php _e( '0 = no limit', 'wp-club-manager' ); ?>)</td>
					</tr>
					<tr>
						<?php $field = 'season'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Season', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_season',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							));
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'team'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Team', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories( array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_team',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'jobs'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Jobs', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories( array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_jobs',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'orderby'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order by', 'wp-club-manager' ); ?></label></th>
						<td>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<option id="name" value="name"<?php if ( $args[$field] == 'name' ) echo ' selected'; ?>><?php _e( 'Alphabetical' ); ?></option>
								<option id="menu_order" value="menu_order"<?php if ( $args[$field] == 'menu_order' ) echo ' selected'; ?>><?php _e( 'Page order' ); ?></option>
								<option id="rand" value="rand"<?php if ( $args[$field] == 'rand' ) echo ' selected'; ?>><?php _e( 'Random' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'order'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							$wpcm_order_options = array(
								'ASC' => __( 'Lowest to highest', 'wp-club-manager' ),
								'DESC' => __( 'Highest to lowest', 'wp-club-manager' )
							);
							?>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<?php foreach ( $wpcm_order_options as $key => $val ) { ?>
									<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $args[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'linktext'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link text', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" /></td>
					</tr>
					<tr>
						<?php $field = 'linkpage'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link page', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_pages( array(
								'show_option_none' => __( 'None', 'wp-club-manager' ),
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'stats'; ?>
						<th><label><?php _e( 'Display options', 'wp-club-manager' ); ?></label></th>
						<td>
							<table>
								<tr>
									<?php
									$count = 0;
									foreach ( $stats_labels as $key => $value ) {
										$count++;
										if ( $count > 3 ) {
											$count = 1;
											echo '</tr><tr>';
										}
									?>
										<td>
											<label class="selectit" for="option-<?php echo $field; ?>-<?php echo $key; ?>">
												<input type="checkbox" id="option-<?php echo $field; ?>-<?php echo $key; ?>" name="<?php echo $field; ?>[]" value="<?php echo $key; ?>" <?php checked( in_array( $key, $stats ) ); ?> />
												<?php echo $value; ?>
											</label>
										</td>
									<?php } ?>
								</tr
							></table>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'wp-club-manager' ), __( 'Staff', 'wp-club-manager' ) ); ?>" name="submit" />
				</p>
			</div>
		
		<?php die();
	}

	/**
	* wpcm_club_buttons_ajax function.
	*/
	public function standings_shortcode_ajax() {

		$defaults = array(
			'limit' => 7,
			'comp' => null,
			'season' => null,
			'orderby' => 'pts',
			'order' => 'DESC',
			'linktext' => __( 'View all standings', 'wp-club-manager' ),
			'linkpage' => null,
			'stats' => 'p,w,d,l,f,a,gd,pts',
			'title' => __( 'Standings', 'wp-club-manager' ),
			'thumb' => 1,
			'linkclub' => 1,
		);
		$args = array_merge( $defaults, $_GET );

		$wpcm_standings_stats_labels = array(
			'p' => get_option( 'wpcm_standings_p_label' ),
			'w' => get_option( 'wpcm_standings_w_label' ),
			'd' => get_option( 'wpcm_standings_d_label' ),
			'l' => get_option( 'wpcm_standings_l_label' ),
			'otw' => get_option( 'wpcm_standings_otw_label' ),
			'otl' => get_option( 'wpcm_standings_otl_label' ),
			'pct' => get_option( 'wpcm_standings_pct_label' ),
			'f' => get_option( 'wpcm_standings_f_label' ),
			'a' => get_option( 'wpcm_standings_a_label' ),
			'gd' => get_option( 'wpcm_standings_gd_label' ),
			'b' => get_option( 'wpcm_standings_bonus_label' ),
			'pts' => get_option( 'wpcm_standings_pts_label' )
		); ?>
			<div id="wpcm_standings-form">
				<table id="wpcm_standings-table" class="form-table">
					<tr>
						<?php $field = 'title'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Title', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" class="widefat" /></td>
					</tr>
					<tr>
						<?php $field = 'limit'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Limit', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" size="3" /> (<?php _e( '0 = no limit', 'wp-club-manager' ); ?>)</td>
					</tr>
					<tr>
						<?php $field = 'comp'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Competition', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_comp',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							));
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'season'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Season', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_categories(array(
								'show_option_none' => __( 'All', 'wp-club-manager' ),
								'hide_empty' => 0,
								'orderby' => 'title',
								'taxonomy' => 'wpcm_season',
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							));
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'orderby'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order by', 'wp-club-manager' ); ?></label></th>
						<td>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<?php foreach ( $wpcm_standings_stats_labels as $key => $val ) { ?>
									<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $args[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>
								<?php } ?>
								<option id="rand" value="rand"<?php if ( $args[$field] == 'rand' ) echo ' selected'; ?>><?php _e( 'Random', 'wp-club-manager' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'order'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php $wpcm_order_options = array(
								'ASC' => __( 'Lowest to highest', 'wp-club-manager' ),
								'DESC' => __( 'Highest to lowest', 'wp-club-manager' )
							); ?>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<?php foreach ( $wpcm_order_options as $key => $val ) { ?>
									<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $args[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'linktext'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link text', 'wp-club-manager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" /></td>
					</tr>
					<tr>
						<?php $field = 'linkpage'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link page', 'wp-club-manager' ); ?></label></th>
						<td>
							<?php
							wp_dropdown_pages( array(
								'show_option_none' => __( 'None', 'wp-club-manager' ),
								'selected' => $args[$field],
								'name' => $field,
								'id' => 'option-' . $field
							) );
							?>
						</td>
					</tr>
					<tr>
						<?php $field = 'thumb'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Show Thumbnail', 'wp-club-manager' ); ?></label></th>
						<td>
							<input type="checkbox" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" checked />
						</td>
					</tr>
					<tr>
						<?php $field = 'linkclub'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Link to Clubs', 'wp-club-manager' ); ?></label></th>
						<td>
							<input type="checkbox" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" checked />
						</td>
					</tr>
					<tr>
						<?php $field = 'stats'; ?>
						<th><label><?php _e( 'Display columns', 'wp-club-manager' ); ?></label></th>
						<td>
							<table style="text-align: center;">
								<tr>
									<?php
									foreach ( $wpcm_standings_stats_labels as $key => $value ) {
									?>
										<td>
											<label class="selectit" for="option-<?php echo $field; ?>-<?php echo $key; ?>">
												<input type="checkbox" id="option-<?php echo $field; ?>-<?php echo $key; ?>" name="<?php echo $field; ?>[]" value="<?php echo $key; ?>" checked />
												<?php echo $value; ?>
											</label>
										</td>
									<?php } ?>
								</tr
							></table>
						</td>
					</tr>
				</table>
				<p class="submit">
					<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'wp-club-manager' ), __( 'Standings', 'wp-club-manager' ) ); ?>" name="submit" />
				</p>
			</div>
		
		<?php die();
	}
}

new WPCM_AJAX();