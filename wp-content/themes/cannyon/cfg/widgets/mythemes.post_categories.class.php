<?php
if( !class_exists( 'mythemes_post_categories' ) ){

class mythemes_post_categories extends WP_Widget
{
    function __construct()
    {
        parent::__construct( 'mythemes_post_categories', __( 'Post Categories' , 'cannyon' ) . ' [' . mythemes_core::author( 'name' ) . ']', array( 
            'classname'     => 'widget_post_categories', 
            'description'   => __( 'Use only for single template' , 'cannyon' )
        ));
    }

    function widget( $args, $instance )
    {
        /* PRINT THE WIDGET */
        extract( $args , EXTR_SKIP );
        $instance = wp_parse_args( (array) $instance, array(
            'title' => ''
        ));

        $title = $instance[ 'title' ];
        
        if( is_singular( 'post' ) && has_category( ) ){
            echo $before_widget;

            if( !empty( $title ) ){
                echo $before_title;
                echo apply_filters( 'widget_title', esc_attr( $title ), $instance, $this -> id_base );
                echo $after_title;
            }

            echo '<div><ul><li>';
            the_category( '</li><li>' );
            echo '</li></ul></div>';

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

register_widget( 'mythemes_post_categories' );

}   /* END IF CLASS EXISTS */
?>