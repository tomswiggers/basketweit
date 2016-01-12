<?php

if( !class_exists( 'mythemes_core' ) ){

class mythemes_core
{
    /* AUTHOR */
    static function author( $key )
    {
        $cfgs = mythemes_cfg::get( 'author' );

        return $cfgs[ $key ];
    }

    /* THEME */
    static function theme( $key )
    {
        $cfgs = mythemes_cfg::get( 'theme' );

        $rett = '';

        $theme = wp_get_theme();

        if( $key == 'type' && isset( $cfgs[ 'type' ] ) ){
            $rett = $cfgs[ 'type' ];
        }
        else if( $key == 'description' && isset( $cfgs[ 'description' ]  ) ){
            $rett = $cfgs[ 'description' ];
        }
        else if( $key == 'premium' && isset( $cfgs[ 'premium' ]  ) ){
            $rett = $cfgs[ 'premium' ];
        }
        else if( isset( $theme -> $key ) ){
            $rett = $theme -> $key;
        }

        return $rett;
    }

    static function exists_premium()
    {
        $cfgs = mythemes_cfg::get( 'theme' );

        $rett = false;

        if( isset( $cfgs[ 'premium' ] ) ){
            $rett = true;
        }

        return $rett;
    }

    static function version()
    {
        $type = self::theme( 'type' );
        $ver = self::theme( 'version' );

        $rett = ' version ( ' . $ver . ' )';

        if( $type == 'free' ){
            $rett = ' free version ( '. $ver . ' )';
        }

        return $rett;
    }

    /* LINKS */
    static function links( $key )
    {
        $cfgs = mythemes_cfg::get( 'links' );

        return $cfgs[ $key ];
    }
}

} /* END IF CLASS EXISTS */
?>