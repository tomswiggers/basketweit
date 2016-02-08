<?php global $post, $posts_total, $posts_index; ?>
<article <?php post_class(); ?>>

    <h2 class="post-title">
        <?php if( !empty( $post -> post_title ) ) { ?>

            <a href="<?php the_permalink() ?>" title="<?php echo mythemes_post::title( $post -> ID, true ); ?>"><?php the_title(); ?></a>

        <?php } else { ?>
    
            <a href="<?php the_permalink() ?>"><?php _e( 'Read more about ..' , 'cannyon' ) ?></a>
    
        <?php } ?>
    </h2>

    <?php get_template_part( 'templates/meta/top' ); ?>

    <?php
    	$p_thumbnail = get_post( get_post_thumbnail_id( $post -> ID ) );

        if( has_post_thumbnail( $post -> ID ) && isset( $p_thumbnail -> ID ) ){
    ?>
            <div class="post-thumbnail overflow-wrapper">
                <?php 
                	echo get_the_post_thumbnail( $post -> ID ,  'mythemes-classic' , array(
                		'alt' 	=> mythemes_post::title( $post -> ID, true ),
                	 	'class' => 'img-background effect-scale'
                	 ));
                ?>      
                <a href="<?php echo get_permalink( $post -> ID ); ?>" class="valign-cell-wrapper" title="<?php echo mythemes_post::title( $post -> ID, true ); ?>">
                </a>
                <?php
                    $c_thumbnail = isset( $p_thumbnail -> post_excerpt ) ? esc_html( $p_thumbnail -> post_excerpt ) : null;

                    if( !empty( $c_thumbnail ) ){
                        echo '<div class="valign-bottom-cell-wrapper">';
                        echo '<footer class="valign-cell">' . $c_thumbnail . '</footer>';
                        echo '</div>';
                    }
                ?>
            </div>
    <?php
        }
    ?>

    <div class="post-content">

        <?php
            $read_more_link =   '<span class="hidden-xs">' . __( 'Read More' , 'cannyon' ) . '</span>'.
                                '<span class="hidden-sm hidden-md hidden-lg"><i class="mythemes-icon-right-big"></i></span>';
            if( !empty( $post -> post_excerpt ) ){
                the_excerpt();
                echo '<a href="' . get_permalink( $post -> ID ) . '" class="more-link">';
                echo $read_more_link;
                echo '</a>';
            }
            else{
                the_content( $read_more_link );
            }

            $fn_exists = function_exists( 'stats_get_csv' ) && get_theme_mod( 'mythemes-nr-views', true );

            if( $fn_exists ) {
            ?>
                <div class="mythemes-post-social">
                <?php

                    /* VIEW COUNTER jetpack PLUGIN */
                    $args = array(
                        'days'      => -1,
                        'post_id'   => $post -> ID,
                    );

                    $result = stats_get_csv( 'postviews' , $args );
                    $nr 	= absint( $result[0]['views'] );
                ?>
                    <span class="mythemes-post-views">
                        <strong><?php echo number_format_i18n( $nr ) ?></strong>
                        <span><?php echo _n( 'view' , 'views' , $nr , 'cannyon' ); ?></span>
                    </span>
                </div>
        <?php
            }
        ?>
        <div class="clearfix"></div>

    </div>
</article>