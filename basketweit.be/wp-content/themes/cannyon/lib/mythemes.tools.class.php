<?php
if( !class_exists( 'mythemes_tools' ) ){
    
class mythemes_tools
{
    /* WEB RESOURCES */
    static function is_url( $url )
    {
        $self_host = str_replace( '.' , '\.' ,  $_SERVER[ 'HTTP_HOST' ] );
    
        /* PROTOCOL */
        $regex = "((https?|ftp)\:\/\/)?";

        /* USER AND PASS */
        $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";

        /* HOST OR IP */
        $regex .= "(" . $self_host . "|([a-z0-9-.]*)\.([a-z]{2,3}))";

        /* PORT */
        $regex .= "(\:[0-9]{2,5})?";

        /* PATH */
        $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";

        /* GET QUERY */
        $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?";

        /* ANCHOR */
        $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?";

        $rett = false;
        
        if( preg_match( "/^$regex$/", $url ) ){
            $rett = true;
        }

        return $rett;
    }

    /* CHECK IF IS FLICKR ID  */
    static function is_flickr_id( $id )
    {
        $regex = "/^[0-9]{3,8}@[A-Z]{1,1}[0-9]{1,2}$/";
        $rett = false;

        if( preg_match( $regex , $id ) ){
            $rett = true;
        }

        return $rett;
    }

    /* WORDPRESS RESOURCES */
    static function get_posts( $args = array(), $current = 0 )
    {
        $deff = array(
            'post_type' => 'page',
            'posts_per_page' => 40,
            'post_status' => 'publish'
        );

        if( empty( $args ) ){
            $args = $deff;
        }
        else{
            if( !isset( $args[ 'post_type' ] ) ){
                $args[ 'post_type' ] = $deff[ 'post_type' ];
            }

            if( !isset( $args[ 'posts_per_page' ] ) ){
                $args[ 'posts_per_page' ] = $deff[ 'posts_per_page' ];
            }

            if( !isset( $args[ 'post_status' ] ) ){
                $args[ 'post_status' ] = $deff[ 'post_status' ];
            }
        }

        $query = new WP_Query( $args );

        $rett = array( 0 => __( ' - Select from list - ' , 'cannyon' ) );

        if( count( $query -> posts ) ){
            foreach( $query -> posts as $p ){
                $rett[ $p -> ID ] = esc_attr( get_the_title( $p -> ID ) );
            }
        }

        if( absint( $current ) > 0 && !isset( $rett[ $current ] ) ){
            $p_ = get_post( $current );

            if( isset( $p_ -> ID ) ){
                $rett[ $p_ -> ID ]  = esc_attr( get_the_title( $p_ -> ID ) );
            }
        }

        return $rett;
    }

    /* COLORS */    
    static function hex2rgb( $hex ){
        $hex = str_replace( "#", "", $hex );

        if( strlen( $hex ) == 3 ) {
            $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
            $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
            $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
        } else {
            $r = hexdec( substr( $hex, 0, 2 ) );
            $g = hexdec( substr( $hex, 2, 2 ) );
            $b = hexdec( substr( $hex, 4, 2 ) );
        }

        $rgb = array( $r, $g, $b );
        return implode( ",", $rgb );
    }

    static function brightness( $hex, $steps )
    {
        $steps = max( -255, min( 255, $steps ) );

        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 3 ) {
            $hex = 
            str_repeat( substr( $hex, 0, 1 ), 2) .
            str_repeat( substr( $hex, 1, 1 ), 2 ) .
            str_repeat( substr( $hex, 2, 1 ), 2 );
        }

        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );

        $r = max( 0, min( 255, $r + $steps ) );
        $g = max( 0, min( 255, $g + $steps ) );  
        $b = max( 0, min( 255, $b + $steps ) );

        $r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
        $g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
        $b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

        return '#' . $r_hex . $g_hex . $b_hex;
    }

    static function rss_with_thumbnail( $content )
    {
        global $post;
        if ( has_post_thumbnail( $post->ID ) ){
            $content = '' . get_the_post_thumbnail( $post -> ID, 'thumbnail' , array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '' . $content;
        }
        return $content;
    }

    static function title( $post_id, $is_attr = false )
    {
        $rett = '';

        if( $is_attr ){
            $rett = esc_attr( get_the_title( $post_id ) );
        }
        else{
            $rett = esc_html( get_the_title( $post_id ) );
        }

        return $rett;
    }

    static function submenu( $id )
    {
        global $mythemes_curr_ancestor;

        $pages = get_posts( array(
            'post_type'     => 'page',
            'order'         => 'ASC',
            'post_parent'   => $id
        ) );

        $rett = '';

        if( !empty( $pages ) ){

            $rett = '<ul class="sub-menu">';

            foreach( $pages as $p => $item ){

                $classes = '';

                if( is_page( $item -> ID ) ){
                    $classes = 'current-menu-item';
                    $mythemes_curr_ancestor = true;
                }

                $submenu = self::submenu( $item -> ID );

                if( !empty( $submenu ) ){
                    $classes .= ' menu-item-has-children';

                    if( $mythemes_curr_ancestor  ){
                        $classes .= ' current-menu-ancestor';
                    }
                }

                $rett .= '<li class="menu-item ' . esc_attr( $classes ) . '">';
                $rett .= '<a href="' . esc_url( get_permalink( $item -> ID ) ) . '" title="' . self::title( $item -> ID, true ) . '">' . self::title( $item -> ID ) . '</a>';

                $rett .= $submenu;

                $rett .= '</li>';

            }

            $rett .= '</ul>';
        }

        return $rett;
    }
}

}   /* END IF CLASS EXISTS */
?>