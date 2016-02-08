<?php
/**
 * Fixtures Widget
 *
 * @author 		ClubPress
 * @category 	Widgets
 * @package 	WPClubManager/Widgets
 * @version 	1.3.0
 * @extends 	WPCM_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCM_Fixtures_Widget extends WPCM_Widget {

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->widget_cssclass    = 'wpcm-widget widget-fixtures';
		$this->widget_description = __( 'Display upcoming fixtures.', 'wp-club-manager' );
		$this->widget_id          = 'wpcm_fixtures';
		$this->widget_name        = __( 'WPCM Fixtures', 'wp-club-manager' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Fixtures', 'wp-club-manager' ),
				'label' => __( 'Title', 'wp-club-manager' )
			),
			'limit' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 3,
				'label' => __( 'Limit', 'wp-club-manager' )
			),
			'comp' => array(
				'type'  => 'tax_select',
				'taxonomy'   => 'wpcm_comp',
				'std'   => 'All',
				'label' => __( 'Competition', 'wp-club-manager' ),
			),
			'season' => array(
				'type'  => 'tax_select',
				'taxonomy'   => 'wpcm_season',
				'std'   => 'All',
				'label' => __( 'Season', 'wp-club-manager' ),
			),
			'team' => array(
				'type'  => 'tax_select',
				'taxonomy'   => 'wpcm_team',
				'std'   => 'All',
				'label' => __( 'Team', 'wp-club-manager' ),
			),
			'venue' => array(
				'type'  => 'tax_select',
				'taxonomy'   => 'wpcm_venue',
				'std'   => 'All',
				'label' => __( 'Venue', 'wp-club-manager' ),
			),
			'display_options' => array(
				'type'  => 'section_heading',
				'label' => __( 'Display Options', 'wp-club-manager' ),
				'std'   => '',
			),
			'show_date' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Date', 'wp-club-manager' )
			),
			'show_time' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Kick Off', 'wp-club-manager' )
			),
			'show_comp' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Competition', 'wp-club-manager' )
			),
			'show_team' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Team', 'wp-club-manager' )
			),
			'link_options' => array(
				'type'  => 'section_heading',
				'label' => __( 'Link Options', 'wp-club-manager' ),
				'std'   => '',
			),
			'linktext'  => array(
				'type'  => 'text',
				'std'   => __( 'View all standings', 'wp-club-manager' ),
				'label' => __( 'Link text', 'wp-club-manager' )
			),
			'linkpage' => array(
				'type'  => 'pages_select',
				'label' => __( 'Link page', 'wp-club-manager' ),
				'std'   => 'None',
			),
			
		);
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
	public function widget( $args, $instance ) {

		if ( $this->get_cached_widget( $args ) )
			return;

		ob_start();
		extract( $args );

		$title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		$limit = absint( $instance['limit'] );
		$comp = isset( $instance['comp'] ) ? $instance['comp'] : null;
		$season = isset( $instance['season'] ) ? $instance['season'] : null;
		$team = isset( $instance['team'] ) ? $instance['team'] : null;
		$club = get_option( 'wpcm_default_club' );
		$venue = isset( $instance['venue'] ) ? $instance['venue'] : null;
		$linktext = $instance['linktext'];
		$linkpage = $instance['linkpage'];
		$show_date = ! empty( $instance['show_date'] );
    	$show_time = ! empty( $instance['show_time'] );
    	$show_comp = ! empty( $instance['show_comp'] );
    	$show_team = ! empty( $instance['show_team'] );

    	if ( $limit == 0 )
			$limit = -1;
		if ( $linkpage <= 0 )
			$linkpage = null;
		if ( $club <= 0  )
			$club = null;
		if ( $comp <= 0 )
			$comp = null;
		if ( $season <= 0  )
			$season = null;
		if ( $team <= 0  )
			$team = null;
		if ( $venue <= 0  )
			$venue = null;

		$query_args = array(
			'numberposts' => $limit,
			'order' => 'ASC',
			'orderby' => 'post_date',
			'post_type' => 'wpcm_match',
			'post_status' => 'future',
			'meta_query' => array(
				array(
					'key' => 'wpcm_played',
					'value' => false
				)
			),
			'posts_per_page' => $limit,
		);

		$query_args['meta_query'] = array(
			'relation' => 'OR',
			array(
				'key' => 'wpcm_home_club',
				'value' => $club,
			),
			array(
				'key' => 'wpcm_away_club',
				'value' => $club,
			)
		);

		if ( isset( $comp ) )
			$query_args['tax_query'][] = array(
				'taxonomy' => 'wpcm_comp',
				'terms' => $comp,
				'field' => 'term_id',
			);

		if ( isset( $season ) )
			$query_args['tax_query'][] = array(
				'taxonomy' => 'wpcm_season',
				'terms' => $season,
				'field' => 'term_id',
			);

		if ( isset( $team ) )
			$query_args['tax_query'][] = array(
				'taxonomy' => 'wpcm_team',
				'terms' => $team,
				'field' => 'term_id',
			);

		if ( $venue > 0  )
			$query_args['tax_query'][] = array(
				'taxonomy' => 'wpcm_venue',
				'terms' => $venue,
				'field' => 'term_id',
			);

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		echo '<div class="wpcm-matches-widget clearfix"><ul>';

		$r = new WP_Query( $query_args );

		if ( $r->have_posts() ) {
		
			while ( $r->have_posts()) {
				$r->the_post();
				wpclubmanager_get_template( 'content-widget-fixtures.php', array( 'limit' => $limit, 'linktext' => $linktext, 'linkpage' => $linkpage, 'show_date' => $show_date, 'show_time' => $show_time, 'show_comp' => $show_comp, 'show_team' => $show_team, ) );
			}	
		} else {
			echo '<li class="inner">'.__('No more matches scheduled.', 'wp-club-manager').'</li>';
		}
		
		echo '</ul>';

	
		if ( isset( $linkpage ) )
			echo '<a href="' . get_page_link( $linkpage ) . '" class="wpcm-view-link">' . $linktext . '</a>';
	
		echo '</div>';

		echo $after_widget;

		wp_reset_postdata();

		$content = ob_get_clean();

		echo $content;

		$this->cache_widget( $args, $content );
	}
}