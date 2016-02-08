<?php
if( !class_exists( 'mythemes_post_meta' ) ){

class mythemes_post_meta extends WP_Widget
{
    function __construct()
    {
        parent::__construct( 'mythemes_post_meta', __( 'Post Meta' , 'cannyon' ) . ' [' . mythemes_core::author( 'name' ) . ']', array( 
            'classname'     => 'widget_post_meta', 
            'description'   => __( 'Use only for single template' , 'cannyon' )
        ));
    }

    function widget( $args, $instance )
    {    
        global $post;

        /* PRINT THE WIDGET */
        extract( $args , EXTR_SKIP );
        $instance = wp_parse_args( (array) $instance, array( 
            'title' => ''
        ));
        
        $title = $instance[ 'title' ];
        
        if( !is_single() ){
            return; 
        }
        
        echo $before_widget;
        
        if( !empty( $title ) ) {
            echo $before_title;
            echo apply_filters( 'widget_title', esc_attr( $title ), $instance, $this -> id_base );
            echo $after_title;
        }
        
        $y      = esc_attr( get_post_time( 'Y', false, $post -> ID ) );
        $m      = esc_attr( get_post_time( 'm', false, $post -> ID ) );
        $d      = esc_attr( get_post_time( 'd', false, $post -> ID ) );

        $name   = get_the_author_meta( 'display_name' , $post -> post_author );
        $dtime  = get_post_time( 'Y-m-d', false, $post -> ID  );
        $ptime  = get_post_time( esc_attr( get_option( 'date_format' ) ), false , $post -> ID, true );

        echo '<div class="large-icons">';
        echo '<ul>';
        edit_post_link( '<i class="mythemes-icon-pencil"></i>' . __( 'Edit' , 'cannyon' ) , '<li>', '</li>' );
        echo '<li><a href="' . esc_url( get_day_link( $y , $m , $d ) ) . '">';
        echo '<time datetime="' . esc_attr( $dtime ) . '"><i class="mythemes-icon-calendar"></i>' . esc_html( $ptime ) . '</time></a></li>';
        echo '<li><a href="' . esc_url( get_author_posts_url( $post -> post_author ) ) . '" title="' . sprintf( __( 'Writed by %s' , 'cannyon' ), esc_attr( $name ) ) . '"><i class="mythemes-icon-user-5"></i>' . esc_html( $name ) . '</a></li>';
        
        if( $post -> comment_status == 'open' ) {
            $nr = get_comments_number( $post -> ID );
            echo '<li>';
            echo '<a href="' . esc_url( get_comments_link( $post -> ID ) ) . '">';
            echo '<i class="mythemes-icon-comment"></i>';
            echo sprintf( _nx( '%s Comment' , '%s Comments' , absint( $nr ) , 'Number of comment(s) from widget "myThemes: Meta Details"' , 'cannyon' ), number_format_i18n( absint( $nr ) ) );
            echo '</a></li>';
        }

        if( function_exists( 'stats_get_csv' ) ) {
            $args = array(
                'days'      => -1,
                'post_id'   => $post -> ID,
            );

            $result = stats_get_csv( 'postviews' , $args );
            $views  = $result[ 0 ][ 'views' ];

            echo '<li><i class="mythemes-icon-eye-2"></i> ' . sprintf( _n( '%s view' , '%s views' , absint( $views ) , 'cannyon' ) , number_format_i18n( absint( $views ) ) ) . '</li>';
        }

        echo '</ul>';
        echo '</div>';
        
        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        /* UPATE THE WIDGET OPTIONS */
        $instance               = $old_instance;
        $instance[ 'title' ]    = esc_attr( strip_tags( $new_instance[ 'title' ] ) );
        return $instance;
    }

    function form( $instance )
    {
        /* PRINT WIDGET FORM */
        $instance = wp_parse_args( (array) $instance, array( 
            'title' => ''
        ));
        
        $title = $instance[ 'title' ];
        
        echo '<p>';
        echo '<label for="' . $this -> get_field_id( 'title' ) . '">' . __( 'Title' , 'cannyon' );
        echo '<input type="text" class="widefat" id="' . $this -> get_field_id( 'title' ) . '" name="' . $this -> get_field_name( 'title' ) . '" value="' . esc_attr( $title ) . '" />';
        echo '</label>';
        echo '</p>';
    }
}

register_widget( 'mythemes_post_meta' );

}   /* END IF CLASS EXISTS */
?>