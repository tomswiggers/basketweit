<?php
    $show_top_meta = is_singular( 'post' ) ? (bool)get_theme_mod( 'mythemes-top-meta', true ) : true;

    if( $show_top_meta ){
?>
        <div class="mythemes-top-meta meta">

            <!-- GET FIRST 2 CATEGORIES -->
            <?php the_category(); ?>

            <!-- AUTHOR -->
            <?php $name = get_the_author_meta( 'display_name' , $post -> post_author ); ?>
            <a class="author" href="<?php echo esc_url( get_author_posts_url( $post-> post_author ) ); ?>" title="<?php echo sprintf( __( 'Writed by %s' , 'cannyon' ) , esc_attr( $name ) ); ?>"><?php echo sprintf( __( 'by %s' , 'cannyon' ) , esc_html( $name ) ); ?></a>

            <!-- DATE -->
            <?php
                $t_time = get_post_time( 'Y-m-d', false , $post -> ID  );
                $u_time = get_post_time( esc_attr( get_option( 'date_format' ) ) );
            ?>
            <time datetime="<?php echo esc_attr( $t_time ); ?>"><?php echo sprintf( __( 'on %s' , 'cannyon' ), $u_time, false, $post -> ID, true ); ?></time>

            <!-- COMMENTS -->
            <?php
                if( $post -> comment_status == 'open' ) {
                    $nr = absint( get_comments_number( $post -> ID ) );
                    echo '<a class="comments" href="' . esc_url( get_comments_link( $post -> ID ) ) . '">';
                    echo '<span>' . sprintf( _nx( '%s Comment' , '%s Comments' , absint( $nr ) , 'Number of comment(s) from post meta' , 'cannyon' ) , number_format_i18n( $nr ) ) . '</span>';
                    echo '</a>';
                }
            ?>
        </div>
<?php
    }
?>