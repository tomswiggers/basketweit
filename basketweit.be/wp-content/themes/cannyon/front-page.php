<?php get_header(); ?>

<?php
    global $wp_customize;

	$are_active_sidebras =  is_active_sidebar( 'front-page-header-first' ) ||
                            is_active_sidebar( 'front-page-header-second' ) ||
                            is_active_sidebar( 'front-page-header-third' );

    $items_class = '';

    /* WP CUSTOMIZE */
    if( isset( $wp_customize ) ){
        $items = true;
        $items_class = !($are_active_sidebras || (bool)get_theme_mod( 'mythemes-default-content', true ) ) ? 'hidden' : '';
    }

    /* FRONTEND */
    else{
        $items = $are_active_sidebras || (bool)get_theme_mod( 'mythemes-default-content', true );
    }
        
    if( $items ){
?>
    <div class="mythemes-white mythemes-default-content <?php echo esc_attr( $items_class ); ?>">
        <div class="content">
            <div class="container">
                <!-- FEATURES -->
                <aside class="row mythemes-header-items">

                    <!-- FEATURE 1 -->
                    <div class="col-sm-6 col-md-4 col-lg-4 header-item">
                        <?php get_sidebar( 'front-page-header-first' ); ?>
                    </div>

                    <!-- FEATURE 2 -->
                    <div class="col-sm-6 col-md-4 col-lg-4 header-item">
                        <?php get_sidebar( 'front-page-header-second' ); ?>
                    </div>

                    <div class="clearfix visible-xs-block visible-sm-block"></div>

                    <!-- FEATURE 3 -->
                    <div class="col-sm-6 col-md-4 col-lg-4 header-item">
                        <?php get_sidebar( 'front-page-header-third' ); ?>
                    </div>
                    
                </aside>
            </div>
        </div>
    </div>
<?php
    }
?>

<div class="content main-content">
    <div class="container">
        <div class="row">

            <?php
                if( get_option( 'show_on_front' ) == 'page' ){

                    /* GET LAYOUT DETAILS */
                    $mythemes_layout = new mythemes_layout( 'front-page' );

                    /* LEFT SIDEBAR */
                    $mythemes_layout -> sidebar( 'left' );
            ?>
                    <!-- CONTENT -->
                    <section class="<?php echo $mythemes_layout -> classes(); ?>">

                    <?php

                        $wp_query = new WP_Query(array(
                            'p' 		=> get_option( 'page_on_front' ),
                            'post_type' => 'page'
                        ));

                        $not_found = true;

                        if( count( $wp_query -> posts ) ){

                            $classes = implode( ' ' , get_post_class( 'mythemes-page' , absint( get_option( 'page_on_front' ) ) ) );

                            /* CONTENT WRAPPER */
                            echo '<div class="' . $classes . '">';

                            foreach( $wp_query -> posts as $post ){

                                $wp_query -> the_post();

                                $p_thumbnail = get_post( get_post_thumbnail_id() );

                                if( has_post_thumbnail() && isset( $p_thumbnail -> ID ) ){
                                	?>
	                                    <div class="post-thumbnail">
	                                    <?php
	                                    	echo get_the_post_thumbnail( $post -> ID, 'full', array( 
	                                    		'alt' 	=> mythemes_post::title( $post -> ID, true )
	                                    	));

	                                    	$c_thumbnail = !empty( $p_thumbnail -> post_excerpt ) ? esc_html( $p_thumbnail -> post_excerpt ) : null;
	                                    
	                                        if( !empty( $c_thumbnail ) ) {
	                                    		?>
		                                            <footer class="wp-caption">
		                                                <?php echo $c_thumbnail; ?>
		                                            </footer>
	                                    		<?php
	                                        }
	                                    ?>
	                                    </div>
                                	<?php
                            	}

                                /* CONTENT */
                                the_content();

                                echo '<div class="clearfix"></div>';

                                /* PAGE PAGINATION */
                                wp_link_pages( array( 
                                    'before'        => '<div class="mythemes-paged-post"><span class="mythemes-pagination-title">' . __( 'Pages', 'cannyon' ) . ': </span>',
                                    'after'         => '</div>',
                                    'link_before'   => '<span class="mythemes-pagination-item">',
                                    'link_after'   	=> '</span>'
                                ));

                                echo '<div class="clearfix"></div>';
                                echo '</div>';
                            }

                            $not_found = false;
                        }

                        /* NOT FOUND RESULT */
                        if( $not_found ){
                            echo '<h3>' . __( 'No results found' , 'cannyon' ) . '</h3>';
                            echo '<p>' . __( 'We apologize but this page, post or resource does not exist or can not be found.' , 'cannyon' ) . '</p>';
                        }
                    ?>

                    </section>
            <?php
                    /* RIGHT SIDEBAR */
                    $mythemes_layout -> sidebar( 'right' );

                }else{
                    get_template_part( 'templates/loop' );
                }
            ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>