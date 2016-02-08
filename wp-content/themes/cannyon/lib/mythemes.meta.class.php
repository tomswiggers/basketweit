<?php

if( !class_exists( 'mythemes_meta' ) ){

class mythemes_meta
{
    static function get( $post_id, $metakey, $default = null )
    {
        $metakey = 'mythemes-' . $metakey;
        
        $rett = get_post_meta( $post_id , $metakey , true );
        
        if( $rett == null )
            $rett = $default;
        
        return $rett;
    }
    
    static function set( $post_id, $metakey, $value )
    {
        $metakey = 'mythemes-' . $metakey;
        return update_post_meta( $post_id , $metakey , $value );
    }
}

} /* END IF CLASS EXISTS */
?>