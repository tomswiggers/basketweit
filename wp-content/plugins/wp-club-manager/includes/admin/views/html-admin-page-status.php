<?php
/**
 * Admin View: Page - Status
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="wrap wpclubmanager-status">
	<h2>
		<?php _e( 'WP Club Manager Status', 'wp-club-manager' ); ?>
	</h2>

	<div class="updated wpclubmanager-message">
		<p><?php _e( 'Please copy and paste this information in your ticket when contacting support:', 'wp-club-manager' ); ?> </p>
		<p class="submit"><a href="#" class="button-primary debug-report"><?php _e( 'Get System Report', 'wp-club-manager' ); ?></a>
		</p>
		<div id="debug-report">
			<textarea readonly="readonly"></textarea>
			<p class="submit"><button id="copy-for-support" class="button-primary" href="#" data-tip="<?php _e( 'Copied!', 'wp-club-manager' ); ?>"><?php _e( 'Copy for Support', 'wp-club-manager' ); ?></button></p>
		</div>
	</div>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">

			<div id="postbox-container-2" class="postbox-container">

				<table class="wpcm_status_table widefat" cellspacing="0" id="status">
					<thead>
						<tr>
							<th colspan="3" data-export-label="WordPress Environment"><?php _e( 'WordPress Environment', 'wp-club-manager' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-export-label="Home URL"><?php _e( 'Home URL', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The URL of your site\'s homepage.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php form_option( 'home' ); ?></td>
						</tr>
						<tr>
							<td data-export-label="Site URL"><?php _e( 'Site URL', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The root URL of your site.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php form_option( 'siteurl' ); ?></td>
						</tr>
						<tr>
							<td data-export-label="WPCM Version"><?php _e( 'WPCM Version', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The version of WP Club Manager installed on your site.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo esc_html( WPCM()->version ); ?></td>
						</tr>
						<tr>
							<td data-export-label="WP Version"><?php _e( 'WP Version', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The version of WordPress installed on your site.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php bloginfo('version'); ?></td>
						</tr>
						<tr>
							<td data-export-label="WP Multisite"><?php _e( 'WP Multisite', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'Whether or not you have WordPress Multisite enabled.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php if ( is_multisite() ) echo '<mark class="yes">' . '&#10003;' . '</mark>'; else echo '<mark class="no">' . '&#10007;' . '</mark>'; ?></td>
						</tr>
						<tr>
							<td data-export-label="WP Memory Limit"><?php _e( 'WP Memory Limit', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The maximum amount of memory (RAM) that your site can use at one time.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php
								$memory = wpcm_let_to_num( WP_MEMORY_LIMIT );

								if ( $memory < 67108864 ) {
									echo '<mark class="error">' . sprintf( __( '%s - We recommend setting memory to at least 64MB. See: <a href="%s" target="_blank">Increasing memory allocated to PHP</a>', 'wp-club-manager' ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
								} else {
									echo '<mark class="yes">' . size_format( $memory ) . '</mark>';
								}
							?></td>
						</tr>
						<tr>
							<td data-export-label="WP Debug Mode"><?php _e( 'WP Debug Mode', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'Displays whether or not WordPress is in Debug Mode.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php if ( defined('WP_DEBUG') && WP_DEBUG ) echo '<mark class="yes">' . '&#10003;' . '</mark>'; else echo '<mark class="no">' . '&#10007;' . '</mark>'; ?></td>
						</tr>
						<tr>
							<td data-export-label="Language"><?php _e( 'Language', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The current language used by WordPress. Default = English', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo get_locale() ?></td>
						</tr>
					</tbody>
				</table>
				<table class="wpcm_status_table widefat" cellspacing="0" id="status">
					<thead>
						<tr>
							<th colspan="3" data-export-label="Server Environment"><?php _e( 'Server Environment', 'wp-club-manager' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-export-label="Server Info"><?php _e( 'Server Info', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'Information about the web server that is currently hosting your site.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
						</tr>
						<tr>
							<td data-export-label="PHP Version"><?php _e( 'PHP Version', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The version of PHP installed on your hosting server.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php
								// Check if phpversion function exists
								if ( function_exists( 'phpversion' ) ) {
									$php_version = phpversion();

									if ( version_compare( $php_version, '5.4', '<' ) ) {
										echo '<mark class="error">' . sprintf( __( '%s - We recommend a minimum PHP version of 5.4. See: <a href="%s" target="_blank">How to update your PHP version</a>', 'wp-club-manager' ), esc_html( $php_version ), 'http://docs.woothemes.com/document/how-to-update-your-php-version/' ) . '</mark>';
									} else {
										echo '<mark class="yes">' . esc_html( $php_version ) . '</mark>';
									}
								} else {
									_e( "Couldn't determine PHP version because phpversion() doesn't exist.", 'wp-club-manager' );
								}
								?></td>
						</tr>
						<?php if ( function_exists( 'ini_get' ) ) : ?>
							<tr>
								<td data-export-label="PHP Post Max Size"><?php _e( 'PHP Post Max Size', 'wp-club-manager' ); ?>:</td>
								<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The largest filesize that can be contained in one post.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
								<td><?php echo size_format( wpcm_let_to_num( ini_get('post_max_size') ) ); ?></td>
							</tr>
							<tr>
								<td data-export-label="PHP Time Limit"><?php _e( 'PHP Time Limit', 'wp-club-manager' ); ?>:</td>
								<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The amount of time (in seconds) that your site will spend on a single operation before timing out (to avoid server lockups).', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
								<td><?php echo ini_get('max_execution_time'); ?></td>
							</tr>
							<tr>
								<td data-export-label="PHP Max Input Vars"><?php _e( 'PHP Max Input Vars', 'wp-club-manager' ); ?>:</td>
								<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The maximum number of variables your server can use for a single function to avoid overloads.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
								<td><?php echo ini_get('max_input_vars'); ?></td>
							</tr>
						<?php endif; ?>
						<tr>
							<td data-export-label="MySQL Version"><?php _e( 'MySQL Version', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The version of MySQL installed on your hosting server.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td>
								<?php
								/** @global wpdb $wpdb */
								global $wpdb;
								echo $wpdb->db_version();
								?>
							</td>
						</tr>
						<tr>
							<td data-export-label="Max Upload Size"><?php _e( 'Max Upload Size', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The largest filesize that can be uploaded to your WordPress installation.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo size_format( wp_max_upload_size() ); ?></td>
						</tr>
						<tr>
							<td data-export-label="Default Timezone is UTC"><?php _e( 'Default Timezone is UTC', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The default timezone for your server.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php
								$default_timezone = date_default_timezone_get();
								if ( 'UTC' !== $default_timezone ) {
									echo '<mark class="error">' . '&#10005; ' . sprintf( __( 'Default timezone is %s - it should be UTC', 'wp-club-manager' ), $default_timezone ) . '</mark>';
								} else {
									echo '<mark class="yes">' . '&#10003;' . '</mark>';
								} ?>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="wpcm_status_table widefat" cellspacing="0" id="status">
					<thead>
						<tr>
							<th colspan="3" data-export-label="Active Plugins (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)"><?php _e( 'Active Plugins', 'wp-club-manager' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$active_plugins = (array) get_option( 'active_plugins', array() );

						if ( is_multisite() ) {
							$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
						}

						foreach ( $active_plugins as $plugin ) {

							$plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
							$dirname        = dirname( $plugin );
							$version_string = '';
							$network_string = '';

							if ( ! empty( $plugin_data['Name'] ) ) {

								// link the plugin name to the plugin url if available
								$plugin_name = esc_html( $plugin_data['Name'] );

								if ( ! empty( $plugin_data['PluginURI'] ) ) {
									$plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . __( 'Visit plugin homepage' , 'wp-club-manager' ) . '" target="_blank">' . $plugin_name . '</a>';
								} ?>
								<tr>
									<td><?php echo $plugin_name; ?></td>
									<td class="help">&nbsp;</td>
									<td><?php echo sprintf( _x( 'by %s', 'by author', 'wp-club-manager' ), $plugin_data['Author'] ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
								</tr>
								<?php
							}
						}
						?>
					</tbody>
				</table>
				<table class="wpcm_status_table widefat" cellspacing="0" id="status">
					<thead>
						<tr>
							<th colspan="3" data-export-label="Taxonomies"><?php _e( 'Taxonomies', 'wp-club-manager' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-export-label="Teams"><?php _e( 'Teams', 'wp-club-manager' ); ?>:</td>
							<td class="help">&nbsp;</td>
							<td><?php
								$display_terms = array();
								$terms = get_terms( 'wpcm_team', array( 'hide_empty' => 0 ) );
								foreach ( $terms as $term ) {
									$display_terms[] = strtolower( $term->name ) . ' (' . $term->slug . ')';
								}
								echo implode( ', ', array_map( 'esc_html', $display_terms ) );
							?></td>
						</tr>
						<tr>
							<td data-export-label="Seasons"><?php _e( 'Seasons', 'wp-club-manager' ); ?>:</td>
							<td class="help">&nbsp;</td>
							<td><?php
								$display_terms = array();
								$terms = get_terms( 'wpcm_season', array( 'hide_empty' => 0 ) );
								foreach ( $terms as $term ) {
									$display_terms[] = strtolower( $term->name ) . ' (' . $term->slug . ')';
								}
								echo implode( ', ', array_map( 'esc_html', $display_terms ) );
							?></td>
						</tr>
						<tr>
							<td data-export-label="Competitions"><?php _e( 'Competitions', 'wp-club-manager' ); ?>:</td>
							<td class="help">&nbsp;</td>
							<td><?php
								$display_terms = array();
								$terms = get_terms( 'wpcm_comp', array( 'hide_empty' => 0 ) );
								foreach ( $terms as $term ) {
									$display_terms[] = strtolower( $term->name ) . ' (' . $term->slug . ')';
								}
								echo implode( ', ', array_map( 'esc_html', $display_terms ) );
							?></td>
						</tr>
					</tbody>
				</table>
				<table class="wpcm_status_table widefat" cellspacing="0" id="status">
					<thead>
						<tr>
							<th colspan="3" data-export-label="Theme"><?php _e( 'Theme', 'wp-club-manager' ); ?></th>
						</tr>
					</thead>
						<?php $active_theme = wp_get_theme(); ?>
					<tbody>
						<tr>
							<td data-export-label="Name"><?php _e( 'Name', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The name of the current active theme.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo $active_theme->Name; ?></td>
						</tr>
						<tr>
							<td data-export-label="Version"><?php _e( 'Version', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The installed version of the current active theme.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo $active_theme->Version; ?></td>
						</tr>
						<tr>
							<td data-export-label="Author URL"><?php _e( 'Author URL', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The theme developers URL.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo $active_theme->{'Author URI'}; ?></td>
						</tr>
						<tr>
							<td data-export-label="Child Theme"><?php _e( 'Child Theme', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'Displays whether or not the current theme is a child theme.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php
								echo is_child_theme() ? '<mark class="yes">' . '&#10003;' . '</mark>' : '<mark class="no">' . '&#10007;' . '</mark>';
							?></td>
						</tr>
						<?php
						if( is_child_theme() ) :
							$parent_theme = wp_get_theme( $active_theme->Template );
						?>
						<tr>
							<td data-export-label="Parent Theme Name"><?php _e( 'Parent Theme Name', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The name of the parent theme.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo $parent_theme->Name; ?></td>
						</tr>
						<tr>
							<td data-export-label="Parent Theme Version"><?php _e( 'Parent Theme Version', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The installed version of the parent theme.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo  $parent_theme->Version; ?></td>
						</tr>
						<tr>
							<td data-export-label="Parent Theme Author URL"><?php _e( 'Parent Theme Author URL', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'The parent theme developers URL.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php echo $parent_theme->{'Author URI'}; ?></td>
						</tr>
						<?php endif ?>
						<tr>
							<td data-export-label="WP Club Manager Support"><?php _e( 'WP Club Manager Support', 'wp-club-manager' ); ?>:</td>
							<td class="help"><?php echo '<img class="help_tip" data-tip="' . esc_attr( 'Displays whether or not the current active theme declares WP Club Manager support.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></td>
							<td><?php
								if ( ! current_theme_supports( 'wpclubmanager' ) && ! in_array( $active_theme->template, wpcm_get_core_supported_themes() ) ) {
									echo '<mark class="error">' . __( 'Not Declared', 'wp-club-manager' ) . '</mark>';
								} else {
									echo '<mark class="yes">' . '&#10003;' . '</mark>';
								}
							?></td>
						</tr>
					</tbody>
				</table>
				<table class="wpcm_status_table widefat" cellspacing="0" id="status">
					<thead>
						<tr>
							<th colspan="3" data-export-label="Templates"><?php _e( 'Templates', 'wp-club-manager' ); ?><?php echo ' <img class="help_tip" data-tip="' . esc_attr( 'This section shows any files that are overriding the default WP Club Manager template pages.', 'wp-club-manager' ) . '" src="' . WPCM()->plugin_url() . '/assets/images/help.png" height="16" width="16" />'; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php

							$template_paths     = apply_filters( 'wpclubmanager_template_overrides_scan_paths', array( 'WP Club Manager' => WPCM()->plugin_path() . '/templates/' ) );
							$scanned_files      = array();
							$found_files        = array();
							$outdated_templates = false;

							foreach ( $template_paths as $plugin_name => $template_path ) {
								$scanned_files[ $plugin_name ] = WPCM_Admin_Status::scan_template_files( $template_path );
							}

							foreach ( $scanned_files as $plugin_name => $files ) {
								foreach ( $files as $file ) {
									if ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
										$theme_file = get_stylesheet_directory() . '/' . $file;
									} elseif ( file_exists( get_stylesheet_directory() . '/wpclubmanager/' . $file ) ) {
										$theme_file = get_stylesheet_directory() . '/wpclubmanager/' . $file;
									} elseif ( file_exists( get_template_directory() . '/' . $file ) ) {
										$theme_file = get_template_directory() . '/' . $file;
									} elseif( file_exists( get_template_directory() . '/wpclubmanager/' . $file ) ) {
										$theme_file = get_template_directory() . '/wpclubmanager/' . $file;
									} else {
										$theme_file = false;
									}

									if ( $theme_file ) {
										$core_version  = WPCM_Admin_Status::get_file_version( WPCM()->plugin_path() . '/templates/' . $file );
										$theme_version = WPCM_Admin_Status::get_file_version( $theme_file );

										if ( $core_version && ( empty( $theme_version ) || version_compare( $theme_version, $core_version, '<' ) ) ) {
											if ( ! $outdated_templates ) {
												$outdated_templates = true;
											}
											$found_files[ $plugin_name ][] = sprintf( __( '<code>%s</code> version <strong style="color:red">%s</strong> is out of date. The core version is %s', 'wp-club-manager' ), str_replace( WP_CONTENT_DIR . '/themes/', '', $theme_file ), $theme_version ? $theme_version : '-', $core_version );
										} else {
											$found_files[ $plugin_name ][] = sprintf( '<code>%s</code>', str_replace( WP_CONTENT_DIR . '/themes/', '', $theme_file ) );
										}
									}
								}
							}

							if ( $found_files ) {
								foreach ( $found_files as $plugin_name => $found_plugin_files ) {
									?>
									<tr>
										<td data-export-label="Overrides"><?php _e( 'Overrides', 'wp-club-manager' ); ?> (<?php echo $plugin_name; ?>):</td>
										<td class="help">&nbsp;</td>
										<td><?php echo implode( ', <br/>', $found_plugin_files ); ?></td>
									</tr>
									<?php
								}
							} else {
								?>
								<tr>
									<td data-export-label="Overrides"><?php _e( 'Overrides', 'wp-club-manager' ); ?>:</td>
									<td class="help">&nbsp;</td>
									<td>&ndash;</td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
			<?php include 'html-admin-sidebar.php'; ?>
		</div>
	</div>
</div>

<?php do_action( 'wpclubmanager_system_status' ); ?>

<script type="text/javascript">

	jQuery( 'a.debug-report' ).click( function() {

		var report = '';

		jQuery( '#status thead, #status tbody' ).each(function(){

			if ( jQuery( this ).is('thead') ) {

				var label = jQuery( this ).find( 'th:eq(0)' ).data( 'export-label' ) || jQuery( this ).text();
				report = report + "\n### " + jQuery.trim( label ) + " ###\n\n";

			} else {

				jQuery('tr', jQuery( this ) ).each(function(){

					var label       = jQuery( this ).find( 'td:eq(0)' ).data( 'export-label' ) || jQuery( this ).find( 'td:eq(0)' ).text();
					var the_name    = jQuery.trim( label ).replace( /(<([^>]+)>)/ig, '' ); // Remove HTML
					var the_value   = jQuery.trim( jQuery( this ).find( 'td:eq(2)' ).text() );
					var value_array = the_value.split( ', ' );

					if ( value_array.length > 1 ) {

						// If value have a list of plugins ','
						// Split to add new line
						var output = '';
						var temp_line ='';
						jQuery.each( value_array, function( key, line ){
							temp_line = temp_line + line + '\n';
						});

						the_value = temp_line;
					}

					report = report + '' + the_name + ': ' + the_value + "\n";
				});

			}
		});

		try {
			jQuery( "#debug-report" ).slideDown();
			jQuery( "#debug-report textarea" ).val( report ).focus().select();
			jQuery( this ).fadeOut();
			return false;
		} catch( e ){
			console.log( e );
		}

		return false;
	});

	jQuery( document ).ready( function ( $ ) {
		$( '#copy-for-support' ).tipTip({
			'attribute':  'data-tip',
			'activation': 'click',
			'fadeIn':     50,
			'fadeOut':    50,
			'delay':      0
		});

		$( 'body' ).on( 'copy', '#copy-for-support', function ( e ) {
			e.clipboardData.clearData();
			e.clipboardData.setData( 'text/plain', $( '#debug-report textarea' ).val() );
			e.preventDefault();
		});

	});

</script>