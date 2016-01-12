<?php

if( !class_exists( 'mythemes_deb' ) ){

/*
    This is a class for debugging. This class is included but not used.
    This class is used only in the development of the theme.
*/

class mythemes_deb
{
    static function bt( $_bt )
    {
        $rett = '';
        
        $f = array( );
        $op = array( );
        
        for( $i = 0; $i < count( $_bt ); $i++ ) {
            $d = $_bt[ $i ];
            $f[]  = self::path( $d[ 'file' ] ) . ":{$d[ 'line' ]}";
            $op[] = "{$d[ 'function' ]}( " . $d[ 'args' ][ 0 ] . " )";
        }
        
        $fmax = 0;
        $opmax = 0;
        for( $i = 0; $i < count( $_bt ); $i++ ) {
            if( strlen( $f[ $i ] ) > $fmax )
                $fmax = strlen( $f[ $i ] );
            if( strlen( $op[ $i ] ) > $opmax )
                $opmax = strlen( $op[ $i ] );
        }
        
        for( $i = 0; $i < count( $_bt ); $i++ ) {
            $f[ $i ] .= str_repeat( ' ', $fmax - strlen( $f[ $i ] ) );
            $op[ $i ] .= str_repeat( ' ', $opmax - strlen( $op[ $i ] ) );
        }
        
        for( $i = 0; $i < count( $_bt ); $i++ ) {
            $rett .= $f[ $i ] . ' => ' . $op[ $i ] . "\n";
        }
        
        return $rett;
    }

    /* ECHO */
    static function e( $data, $backtrace = 0 )
    {
        print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
        $bt = debug_backtrace();
        $caller = $bt[ 0 ];
        print "[ File : " . self::path( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
        print "--------------------------------------------------------------\n";
        if( $backtrace ) {
            print self::bt( $bt );
            print "--------------------------------------------------------------\n";
        }
        print_r( $data );
        print "</pre>";
    }

    /* VAR DUMP */
    static function d( $data )
    {
        print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        print "[ File : " . self::path( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
        print "--------------------------------------------------------------\n";
        var_dump( $data );
        print "</pre>";
    }

    /* HTML SPECIAL CHARS */
    static function h( $data )
    {
        print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        print "[ File : " . self::path( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
        print "--------------------------------------------------------------\n";
        print htmlspecialchars( $data );
        print "</pre>";
    }
    
    /* POST */
    static function p()
    {
        print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        print "[ File : " . self::path( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
        print "--------------------------------------------------------------\n";
        print_r( $_POST ) ;
        print "</pre>";
    }
    
    /* GET */
    static function g()
    {
        print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        print "[ File : " . self::path( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
        print "--------------------------------------------------------------\n";
        print_r( $_GET ) ;
        print "</pre>";
    }

    /* REQUEST */
    static function r()
    {
        print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        print "[ File : " . self::path( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
        print "--------------------------------------------------------------\n";
        print_r( $_REQUEST ) ;
        print "</pre>";
    }
    
    /* SERVER */
    static function s()
    {
        print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
        $bt = debug_backtrace();
        $caller = array_shift($bt);
        print "[ File : " . self::path( $caller[ 'file' ] ) . " ][ Line : " . $caller[ 'line' ] . " ]\n";
        print "--------------------------------------------------------------\n";
        print_r( $_SERVER ) ;
        print "</pre>";
    }
    
    /* GET THEME NAME AND PATH */
    static function path( $str )
    {
        $theme = wp_get_theme();
        $str = $theme[ 'Name' ] . ':' . str_replace( str_replace( '/' , '\\' , get_template_directory() ) , '' , $str );
         
        return $str;
    }
}

} /* END IF CLASS EXISTS */
?>