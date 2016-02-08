<?php
if( !class_exists( 'mythemes_header' ) ){

class mythemes_header
{
	static function setup()
	{
		$args = array(
            'default-image'          => get_theme_mod( 'mythemes-header-image', get_template_directory_uri() . '/media/_frontend/img/bkg.jpg' ),
            'random-default'         => true,
            'width'                  => 9999,
            'height'                 => 960,
            'flex-height'            => true,
            'flex-width'             => true,
            'default-text-color'     => 'ffffff',
            'header-text'            => true,
            'uploads'                => true
        );

        add_theme_support( 'custom-header', $args );
	}

	static function head()
	{
        get_template_part( 'templates/head' );
		get_template_part( 'templates/style' );
	}
}

}	/* END IF CLASS EXISTS */
?>