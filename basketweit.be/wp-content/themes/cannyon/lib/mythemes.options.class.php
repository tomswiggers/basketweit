<?php
if( !class_exists( 'mythemes_options' ) ){
    
class mythemes_options
{
    static function set( $option, $value )
    {
        $sett = mythemes_cfg::get_sett( );

        set_theme_mod( 'mythemes-' . $option, self::set_validate( $sett[ $option ], $value ) );
    }
    
    static function get( $option )
    {
        $sett = mythemes_cfg::get_sett( );

        return self::get_validate( $sett[ $option ], self::val( $option ) );
    }

    static function val( $option )
    {
        return get_theme_mod( 'mythemes-' . $option , self::def( $option ) );
    }
    
    static function def( $option )
    {   
        $def = mythemes_cfg::get_def();

        if( isset( $def[ $option ] ) ){
            return $def[ $option ];
        }else{
            return null;
        }
    }

    static function del( $optionSlug )
    {
        $option = 'mythemes-' . $optionSlug;

        return remove_theme_mod( $option );
    }

    static function set_validate( $sett , $value )
    {
        $rett = esc_attr( $value );

        $validator = call_user_func_array( array( new mythemes_options() , 'set_validator_type' ) , array( $sett ) );

        if( !empty( $validator ) ){
            $rett = call_user_func_array( array( new mythemes_options() , $validator ) , array( $value ) );
        }

        return $rett;
    }

    static function get_validate( $sett , $value )
    {
        $rett = esc_attr( $value );

        $validator = call_user_func_array( array( new mythemes_options() , 'get_validator_type' ) , array( $sett ) );

        if( !empty( $validator ) ){
            $rett = call_user_func_array( array( new mythemes_options() , $validator ) , array( $value ) );
        }

        return $rett;
    }

    /* VALIDATOR */
    static function validator( $val )
    {
        return esc_attr( $val );
    }

    static function validator_int( $val )
    {
        return (int)$val;
    }

    static function validator_number( $val )
    {
        return absint( $val );
    }

    static function validator_logic( $val )
    {
        return absint( $val ) ? true : false;
    }

    static function validator_url( $val )
    {
        return esc_url( $val );
    }

    static function get_validator_html( $val )
    {
        return htmlspecialchars_decode( $val );
    }

    static function set_validator_html( $val )
    {
        return htmlspecialchars( $val, null, null, false );
    }

    static function get_validator_css( $val )
    {
        return htmlspecialchars_decode( stripslashes( strip_tags( $val ) ) );
    }

    static function set_validator_css( $val )
    {
        return htmlspecialchars( strip_tags( $val ), null, null, false );
    }

    static function get_validator_copyright( $val )
    {
        return htmlspecialchars_decode( stripslashes( strip_tags( $val , '<a>' ) ) );
    }

    static function set_validator_copyright( $val )
    {
        return htmlspecialchars( stripslashes( strip_tags( $val , '<a>' ) ) , null, null, false );
    }


    static function validator_type( $sett )
    {
        if( !is_array( $sett ) ){
            return null;
        }

        if( !isset( $sett[ 'type' ] ) ){
            return null;
        }

        if( !is_array( $sett[ 'type' ] ) ){
            return null;
        }

        if( !( isset( $sett[ 'type' ][ 'input' ] ) || isset( $sett[ 'type' ][ 'validator' ] ) ) ){
            return null;
        }

        $rett = '';
        
        if( !isset( $sett[ 'type' ][ 'validator' ] ) ){ /* DEFAULT VALIDATOR TYPE */
            switch( $sett[ 'type' ][ 'input' ] ){
                case 'int' : {
                    $rett = 'validator_int';
                    break;
                }
                case 'number' : {
                    $rett = 'validator_number';
                    break;
                }
                case 'logic' : {
                    $rett = 'validator_logic';
                    break;
                }
                case 'url':
                case 'upload':{
                    $rett = 'validator_url';
                    break;
                }
                case 'css' : {
                    $rett = 'css';
                    break;
                }
                case 'html' : {
                    $rett = 'html';
                    break;
                }
                case 'copyright' : {
                    $rett = 'copyright';
                    break;
                }
                default : {
                    $rett = 'validator';
                    break;
                }
            }
        }
        else{
            $rett =  $sett[ 'type' ][ 'validator' ];
        }

        return $rett;
    }

    static function get_validator_type( $sett )
    {
        $rett = self::validator_type( $sett );

        
        switch( $rett ){
            case 'css' : {
                $rett = 'get_validator_css';
                break;
            }
            case 'html' : {
                $rett = 'get_validator_html';
                break;
            }
            case 'copyright' : {
                $rett = 'get_validator_copyright';
                break;
            }
        }

        return $rett;
    }

    static function set_validator_type( $sett )
    {
        $rett = self::validator_type( $sett );

        
        switch( $rett ){
            case 'css' : {
                $rett = 'set_validator_css';
                break;
            }
            case 'html' : {
                $rett = 'set_validator_html';
                break;
            }
            case 'copyright' : {
                $rett = 'set_validator_copyright';
                break;
            }
        }

        return $rett;
    }
}

}   /* END IF CLASS EXISTS */
?>