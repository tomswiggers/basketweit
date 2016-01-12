<?php

function wpcm_ss_get_styles() {

	return apply_filters( 'wpcm_ss_enqueue_styles', array(
		'wpcm-sp-style' => array(
			'src'     => str_replace( array( 'http:', 'https:' ), '', plugins_url( '/css/wpcm-ss.css',  WPCM_SS_PLUGIN_FILE ) ),
			'deps'    => '',
			'version' => WPCM_SS_PLUGIN_FILE,
			'media'   => 'all'
		),
	) );
}

function wpcm_ss_load_scripts() {

	global $post, $wp;

	// CSS Styles
	if ( get_option( 'wpcm_ss_css_off' ) !== 'yes' ) :

		$enqueue_styles = wpcm_ss_get_styles();

		if ( $enqueue_styles ) :
			foreach ( $enqueue_styles as $handle => $args ) :
				wp_enqueue_style( $handle, $args['src'], $args['deps'], $args['media'] );
			endforeach;
		endif;

	endif;
	
}
add_action( 'wp_enqueue_scripts', 'wpcm_ss_load_scripts' );


function wpcm_ss_load_styles() {

	wp_enqueue_style( 'wpcm_ss_admin_styles', plugins_url( '/css/wpcm-ss-admin.css', WPCM_SS_PLUGIN_FILE ), array(), WPCM_VERSION );

}
add_action( 'admin_enqueue_scripts', 'wpcm_ss_load_styles' );