<?php
if( !class_exists( 'mythemes_layout' ) ){

class mythemes_layout
{
    public $contentClass    = '';
    public $layout          = '';
    public $deff            = array(
        'layout'    => array(
            'default'       => 'right',
            'front-page'    => 'right',
            'page'          => 'full',
            'post'          => 'right',
            'special-page'  => 'right'
        ),
        'sidebar'   => array(
            'default'       => 'main',
            'front-page'    => 'front-page',
            'page'          => 'page',
            'post'          => 'post',
            'special-page'  => 'special-page'
        )
    );

    function get( $setting, $template )
    {
        $rett = '';

        switch( $template ){
            case 'front-page' :
            case 'post' :
            case 'page' :
            case 'special-page': {
                $rett = esc_attr( get_theme_mod( 'mythemes-' . $template . '-' . $setting , $this -> deff[ $setting ][ $template ] ) );
                break;
            }
            default : {
                $rett = esc_attr( get_theme_mod( 'mythemes-' . $setting, $this -> deff[ $setting ][ 'default' ] ) );
                break;
            }
        }

        return $rett;
    }

    function mythemes_layout( $template = '' )
    {
        $this -> template   = $template;
        $this -> layout     = $this -> get( 'layout' , $template );
        
        if( $this -> layout == 'left' || $this -> layout == 'right' ){
            $this -> contentClass = 'col-sm-8 col-md-9 col-lg-9';
            return;
        }
        
        $this -> contentClass = 'col-lg-12';
    }
    
    function sidebar( $position )
    {
        $sidebar = $this -> get( 'sidebar', $this -> template );

        if( $this -> layout == $position ){

            echo '<aside class="col-sm-4 col-md-3 col-lg-3 mythemes-sidebar sidebar-to-' . esc_attr( $position ) . '">';
            
            get_sidebar( esc_attr( $sidebar ) );

            echo '</aside>';

            return;
        }
    }

    function classes( ) {
        return esc_attr( $this -> contentClass );
    }
}

}   /* END IF CLASS EXISTS */
?>