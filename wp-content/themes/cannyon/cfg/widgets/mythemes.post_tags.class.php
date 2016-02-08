<?php
if( !class_exists( 'mythemes_post_tags' ) ){

class mythemes_post_tags extends WP_Widget
{
    function __construct()
    {
        parent::__construct( 'mythemes_post_tags', __( 'Post Tags' , 'cannyon' ) . ' [' . mythemes_core::author( 'name' ) . ']', array( 
            'classname'     => 'widget_post_tags', 
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
        
        if( is_singular( 'post' ) && has_tag( ) ){

            echo $before_widget;

            if( !empty( $title ) ){
                echo $before_title;
                echo apply_filters( 'widget_title', esc_attr( $title ), $instance, $this -> id_base );
                echo $after_title;
            }

            echo '<div class="tagcloud">';

            $tags = wp_get_post_tags( $post -> ID );

            foreach( $tags as $t => $tag ){
                $tag_url = get_tag_link( $tag -> term_id );

                if( is_wp_error( $tag_url ) ){
                    continue;
                }

                echo '<a href="' . esc_url( $tag_url ) . '" title="' . absint( $tag -> count ) . '">';
                echo esc_html( $tag -> name );
                echo '</a>';
            }
            
            echo '<div class="clearfix"></div>';
            echo '</div>';

            echo $after_widget;
        }
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

register_widget( 'mythemes_post_tags' );

}   /* END IF CLASS EXISTS */
?>