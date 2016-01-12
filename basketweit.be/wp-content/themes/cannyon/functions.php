<?php
    get_template_part( 'lib/main' );

    add_action( 'after_setup_theme', 	array( 'mythemes_setup', 	'support' ) );
    add_action( 'after_setup_theme',    array( 'mythemes_header',   'setup' ) );

	add_action( 'admin_init', 			array( 'mythemes_scripts', 	'backend' ) );    
	add_action( 'admin_menu', 			array( 'mythemes_admin', 	'pageMenu' ) );

	add_action( 'widgets_init', 		array( 'mythemes_setup', 	'sidebars' ) );
	add_action( 'init', 				array( 'mythemes_setup', 	'menus' ) );


    add_action( 'wp_enqueue_scripts',   array( 'mythemes_scripts',  'frontend' ), 0 );
	add_action( 'wp_head', 				array( 'mythemes_header', 	'head' ) );
	
    add_filter( 'the_excerpt_rss', 		array( 'mythemes_tools', 	'rss_with_thumbnail' ) );
    add_filter( 'the_content_feed', 	array( 'mythemes_tools', 	'rss_with_thumbnail' ) );

    //-  CONDITIONAL / GALLERY -//
    if( get_theme_mod( 'mythemes-gallery-style', true ) ){
        add_action( 'admin_init',           array( 'mythemes_gallery',  'admin_init' ) );
        add_filter( 'post_gallery',         array( 'mythemes_gallery',  'shortcode' ), null, 2 );
    }

    //- BLOG TITLE -//
    function mythemes_title_setup() {
        add_theme_support( 'title-tag' );
    }

    add_action( 'after_setup_theme', 'mythemes_title_setup' );

    /* CUSTOMIZER */
    function mythemes_customize_register( $wp_customize )
	{
        {   //- SITE IDENTITY -//

            $the_panel = array(
                'title'             => __( 'Site Identity', 'cannyon' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 0
            );

            if( mythemes_core::exists_premium() ){
                $the_panel[ 'description' ]   = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_section( 'title_tagline', $the_panel );

            $wp_customize -> add_setting( 'mythemes-logo', array(
                'default'           => get_template_directory_uri() . '/media/_frontend/img/logo.png',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( new WP_Customize_Upload_Control(
                $wp_customize,
                'mythemes-logo',
                array(
                    'label'         => __( 'Preview Logo', 'cannyon' ),
                    'section'       => 'title_tagline',
                    'settings'      => 'mythemes-logo',
                )
            ));

            $wp_customize -> add_setting( 'display_header_text' );
            $wp_customize -> add_control( 'display_header_text', array( 'theme_supports' => false ) );
        }

        {   //- COLORS -//

            $the_panel = array(
                'title'             => __( 'Site Colors' , 'cannyon' ),
                'priority'          => 1,
                'capability'        => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $the_panel[ 'description' ]   = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_section( 'colors', $the_panel );


            //- FIRST SITE COLOR -//
            $wp_customize -> add_setting( 'mythemes-color-1', array(
                'default'           => '#26ad60',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
                'capability'        => 'edit_theme_options',
            ));
            $wp_customize -> add_control( new WP_Customize_Color_Control(
                $wp_customize,
                'mythemes-color-1',
                array(
                    'label'         => __( 'First Site Color', 'cannyon' ),
                    'section'       => 'colors',
                    'settings'      => 'mythemes-color-1'
                )
            ));

            //- SECOND SITE COLOR -//
            $wp_customize -> add_setting( 'mythemes-color-2', array(
                'default'           => '#00aeef',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
                'capability'        => 'edit_theme_options',
            ));
            $wp_customize -> add_control( new WP_Customize_Color_Control(
                $wp_customize,
                'mythemes-color-2',
                array(
                    'label'         => __( 'Second Site Color', 'cannyon' ),
                    'section'       => 'colors',
                    'settings'      => 'mythemes-color-2'
                )
            ));

            /* DISABLE UNSUPPORTED */
            $wp_customize -> add_setting( 'header_textcolor' );
            $wp_customize -> add_control( 'header_textcolor', array( 'theme_supports' => false ) );
        }


        {   //- BACKGROUND IMAGE -//

            $the_panel = array(
                'title'             => __( 'Background Image' , 'cannyon' ),
                'priority'          => 2,
                'capability'        => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $the_panel[ 'description' ] = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_section( 'background_image', $the_panel );
        }


        {   //- HEADER IMAGE -//

            $the_panel = array(
                'title'             => __( 'Header Image', 'cannyon' ),
                'capability'        => 'edit_theme_options',
                'priority'          => 3
            );

            if( mythemes_core::exists_premium() ){
                $the_panel[ 'description' ] = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_section( 'header_image', $the_panel );
        }


    	{   //- HEADER ELEMENTS -//

            $header_panel_args = array(
                'title'         => __( 'Header Elements', 'cannyon' ),
                'priority'      => 4,
                'capability'    => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $header_panel[ 'description' ]   = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_panel( 'mythemes-header-panel', $header_panel_args );


            {   //- GENERAL -//

                $the_panel = array(
                    'title'             => __( 'General' , 'cannyon' ),
                    'priority'          => 30,
                    'panel'             => 'mythemes-header-panel',
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $the_panel[ 'description' ]   = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
                }

                $wp_customize -> add_section( 'mythemes-header', $the_panel );

                //- FRONT PAGE -//
                $wp_customize -> add_setting( 'mythemes-header-front-page', array(
                    'default'           => true,
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-front-page', array(
                    'label'             => __( 'Display Header on Front Page', 'cannyon' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-front-page',
                    'type'              => 'checkbox',
                ));

                //- BLOG PAGE -//
                $wp_customize -> add_setting( 'mythemes-header-blog-page', array(
                    'default'           => true,
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-blog-page', array(
                    'label'             => __( 'Display Header on Blog Page', 'cannyon' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-blog-page',
                    'type'              => 'checkbox',
                ));

                /* TEMPLATES */
                $wp_customize -> add_setting( 'mythemes-header-templates', array(
                    'default'           => true,
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-templates', array(
                    'label'             => __( 'Display Header on Templates', 'cannyon' ),
                    'description'       => __( 'enabale / disable header on: Archives, Categories, Tags, Author, 404 and Search Results.' , 'cannyon' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-templates',
                    'type'              => 'checkbox',
                ));

                /* SINGLE POSTS */
                $wp_customize -> add_setting( 'mythemes-header-single-posts', array(
                    'default'           => true,
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-single-posts', array(
                    'label'             => __( 'Display Header on Single Posts', 'cannyon' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-single-posts',
                    'type'              => 'checkbox',
                ));

                /* SINGLE PAGES */
                $wp_customize -> add_setting( 'mythemes-header-single-pages', array(
                    'default'           => true,
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-single-pages', array(
                    'label'             => __( 'Display Header on Single Pages', 'cannyon' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-single-pages',
                    'type'              => 'checkbox'
                ));

                /* HEIGHT */
                $wp_customize -> add_setting( 'mythemes-header-height', array(
                    'default'           => 480,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-height', array(
                    'label'             => __( 'Header height', 'cannyon' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-height',
                    'type'              => 'range',
                    'input_attrs'       => array(
                        'min'       => 0,
                        'max'       => 800,
                        'step'      => 1,
                        'data-unit' => 'px',
                        'data-deff' => 480
                    )
                ));

                /* HEADER BACKGROUND COLOR */
                $wp_customize -> add_setting( 'mythemes-header-background-color', array(
                    'default'           => '#000000',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-background-color',
                    array(
                        'label'         => __( 'Background Color', 'cannyon' ),
                        'section'       => 'mythemes-header',
                        'settings'      => 'mythemes-header-background-color',
                    )
                ));

                /* MASK COLOR */
                $wp_customize -> add_setting( 'mythemes-header-mask-color', array(
                    'default'           => '#000000',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-mask-color',
                    array(
                        'label'     => __( 'Mask Color', 'cannyon' ),
                        'section'   => 'mythemes-header',
                        'settings'  => 'mythemes-header-mask-color',
                    )
                ));

                /* MASK OPACITY */
                $wp_customize -> add_setting( 'mythemes-header-mask-opacity', array(
                    'default'           => 75,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-mask-opacity', array(
                    'label'             => __( 'Mask Opacity', 'cannyon' ),
                    'description'       => __( 'by default the mask is a dark transparent foil over the header background image.' , 'cannyon' ),
                    'section'           => 'mythemes-header',
                    'settings'          => 'mythemes-header-mask-opacity',
                    'type'              => 'range',
                    'input_attrs' => array(
                        'min'       => 0,
                        'max'       => 100,
                        'step'      => 1,
                        'data-unit' => '%',
                        'data-deff' => 75
                    ),
                ));
            }


            {   /* CONTENT */

                $the_panel = array(
                    'title'             => __( 'Content' , 'cannyon' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $the_panel[ 'description' ]   = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
                }

                $wp_customize -> add_section( 'mythemes-header-content', $the_panel );

                /* HEADER HEADLINE */
                $wp_customize -> add_setting( 'mythemes-header-title', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-title', array(
                    'label'             => __( 'Display Headline', 'cannyon' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-title',
                    'type'              => 'checkbox',
                ));

                $wp_customize -> add_setting( 'mythemes-header-title-label', array(
                    'default'           => __( 'Cannyon is a clean WordPress theme' , 'cannyon' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-title-label', array(
                    'label'             => __( 'Headline', 'cannyon' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-title-label',
                    'type'              => 'text'
                ));

                $wp_customize -> add_setting( 'mythemes-header-title-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-title-color',
                    array(
                        'label'         => __( 'Headline Color', 'cannyon' ),
                        'section'       => 'mythemes-header-content',
                        'settings'      => 'mythemes-header-title-color'
                    )
                ));



                /* HEADER DESCRIPTION  */
                $wp_customize -> add_setting( 'mythemes-header-description', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-description', array(
                    'label'             => __( 'Display Description', 'cannyon' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-description',
                    'type'              => 'checkbox',
                ));

                $wp_customize -> add_setting( 'mythemes-header-description-label', array(
                    'default'           => __( 'freemium WordPress theme developed by myThem.es' , 'cannyon' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-header-description-label', array(
                    'label'             => __( 'Description', 'cannyon' ),
                    'section'           => 'mythemes-header-content',
                    'settings'          => 'mythemes-header-description-label',
                    'type'              => 'text',
                ));

                $wp_customize -> add_setting( 'mythemes-header-description-color', array(
                    'default'           => '#ffffff',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-header-description-color',
                    array(
                        'label'         => __( 'Description Color', 'cannyon' ),
                        'section'       => 'mythemes-header-content',
                        'settings'      => 'mythemes-header-description-color'
                    )
                ));
            }


            {   /* FIRST BUTTON */

                $the_panel = array(
                    'title'             => __( 'First Button' , 'cannyon' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $the_panel[ 'description' ]   = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
                }

                $wp_customize -> add_section( 'mythemes-header-first-btn', $the_panel );

                /* DISPLAY */
                $wp_customize -> add_setting( 'mythemes-first-btn', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn', array(
                    'label'             => __( 'Display first button', 'cannyon' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn',
                    'type'              => 'checkbox'
                ));

                /* URL */
                $wp_customize -> add_setting( 'mythemes-first-btn-url', array(
                    'default'           => esc_url( home_url( '#' ) ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_url_raw',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-url', array(
                    'label'             => __( 'URL', 'cannyon' ),
                    'description'       => __( 'Link for first button', 'cannyon' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-url',
                    'type'              => 'url',
                ));

                /* LABEL */
                $wp_customize -> add_setting( 'mythemes-first-btn-label', array(
                    'default'           => __( 'First Button', 'cannyon' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-label', array(
                    'label'             => __( 'Label', 'cannyon' ),
                    'description'       => __( 'Text for first button', 'cannyon' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-label',
                    'type'              => 'text',
                ));

                /* DESCRIPTION */
                $wp_customize -> add_setting( 'mythemes-first-btn-description', array(
                    'default'           => __( 'first button link description...', 'cannyon' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_textarea',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-first-btn-description', array(
                    'label'             => __( 'Description', 'cannyon' ),
                    'description'       => __( 'link description for first button', 'cannyon' ),
                    'section'           => 'mythemes-header-first-btn',
                    'settings'          => 'mythemes-first-btn-description',
                    'type'              => 'textarea',
                ));

                //- BACKGROUND COLOR -//
                $wp_customize -> add_setting( 'mythemes-first-btn-bkg-color', array(
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-first-btn-bkg-color',
                    array(
                        'label'         => __( 'Background Color', 'cannyon' ),
                        'description'   => __( 'Overwrite First Site Color.', 'cannyon' ),
                        'section'       => 'mythemes-header-first-btn',
                        'settings'      => 'mythemes-first-btn-bkg-color'
                    )
                ));

                //- BACKGROUND COLOR ( OVER ) -//
                $wp_customize -> add_setting( 'mythemes-first-btn-bkg-h-color', array(
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-first-btn-bkg-h-color',
                    array(
                        'label'         => __( 'Background Color ( over )', 'cannyon' ),
                        'description'   => __( 'when the mouse cursor is over the button. Overwrite Second Site Color.', 'cannyon' ),
                        'section'       => 'mythemes-header-first-btn',
                        'settings'      => 'mythemes-first-btn-bkg-h-color'
                    )
                ));
            }


            {   /* SECOND BUTTON */

                $the_panel = array(
                    'title'             => __( 'Second Button' , 'cannyon' ),
                    'panel'             => 'mythemes-header-panel',
                    'priority'          => 30,
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $the_panel[ 'description' ]   = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
                }

                $wp_customize -> add_section( 'mythemes-header-second-btn', $the_panel );

                /* DISPLAY */
                $wp_customize -> add_setting( 'mythemes-second-btn', array(
                    'default'           => true,
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn', array(
                    'label'             => __( 'Display second button', 'cannyon' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn',
                    'type'              => 'checkbox'
                ));

                /* URL */
                $wp_customize -> add_setting( 'mythemes-second-btn-url', array(
                    'default'           => esc_url( home_url( '#' ) ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_url_raw',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-url', array(
                    'label'             => __( 'URL', 'cannyon' ),
                    'description'       => __( 'Link for second button', 'cannyon' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-url',
                    'type'              => 'url'
                ));

                /* LABEL */
                $wp_customize -> add_setting( 'mythemes-second-btn-label', array(
                    'default'           => __( 'Second Button', 'cannyon' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_text_field',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-label', array(
                    'label'             => __( 'Label', 'cannyon' ),
                    'description'       => __( 'Text for second button', 'cannyon' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-label',
                    'type'              => 'text',
                ));

                /* DESCRIPTION */
                $wp_customize -> add_setting( 'mythemes-second-btn-description', array(
                    'default'           => __( 'second button link description...', 'cannyon' ),
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'esc_textarea',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-second-btn-description', array(
                    'label'             => __( 'Description', 'cannyon' ),
                    'description'       => __( 'link description for second button', 'cannyon' ),
                    'section'           => 'mythemes-header-second-btn',
                    'settings'          => 'mythemes-second-btn-description',
                    'type'              => 'textarea'
                ));

                //- BACKGROUND COLOR -//
                $wp_customize -> add_setting( 'mythemes-second-btn-bkg-color', array(
                    'default'           => '#636363',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-second-btn-bkg-color',
                    array(
                        'label'         => __( 'Background Color', 'cannyon' ),
                        'section'       => 'mythemes-header-second-btn',
                        'settings'      => 'mythemes-second-btn-bkg-color'
                    )
                ));

                //- BACKGROUND COLOR ( OVER ) -//
                $wp_customize -> add_setting( 'mythemes-second-btn-bkg-h-color', array(
                    'default'           => '#424242',
                    'transport'         => 'postMessage',
                    'sanitize_callback' => 'sanitize_hex_color',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( new WP_Customize_Color_Control(
                    $wp_customize,
                    'mythemes-second-btn-bkg-h-color',
                    array(
                        'label'         => __( 'Background Color ( over )', 'cannyon' ),
                        'description'   => __( 'when the mouse cursor is over the button', 'cannyon' ),
                        'section'       => 'mythemes-header-second-btn',
                        'settings'      => 'mythemes-second-btn-bkg-h-color'
                    )
                ));
            }
        }


        {   /* BREADCRUMBS */

            $the_panel = array(
                'title'             => __( 'Breadcrumbs' , 'cannyon' ),
                'priority'          => 5,
                'capability'        => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $the_panel[ 'description' ] = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_section( 'mythemes-breadcrumbs', $the_panel );

            /* DISPLAY BREADCRUMBS */
            $wp_customize -> add_setting( 'mythemes-breadcrumbs', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-breadcrumbs', array(
                'label'             => __( 'Display breadcrumbs', 'cannyon' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-breadcrumbs',
                'type'              => 'checkbox',
            ));

            /* LABEL */
            $wp_customize -> add_setting( 'mythemes-home-label', array(
                'default'           => __( 'Home', 'cannyon' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-home-label', array(
                'label'             => __( '"Home" label', 'cannyon' ),
                'description'       => __( 'breadcrumbs "Home" link label.', 'cannyon' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-home-label',
                'type'              => 'text',
            ));

            /* DESCRIPTION */
            $wp_customize -> add_setting( 'mythemes-home-link-description', array(
                'default'           => __( 'go to home', 'cannyon' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_textarea',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-home-link-description', array(
                'label'             => __( '"Home" link description', 'cannyon' ),
                'description'       => __( 'breadcrumbs "Home" link description.', 'cannyon' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-home-link-description',
                'type'              => 'textarea',
            ));

            /* SPACE */
            $wp_customize -> add_setting( 'mythemes-breadcrumbs-space', array(
                'default'           => 60,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_number',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-breadcrumbs-space', array(
                'label'             => __( 'Space', 'cannyon' ),
                'description'       => __( 'inner top and bottom space allow you to change breadcrumbs height.', 'cannyon' ),
                'section'           => 'mythemes-breadcrumbs',
                'settings'          => 'mythemes-breadcrumbs-space',
                'type'              => 'range',
                'input_attrs'       => array(
                    'min'       => 0,
                    'max'       => 100,
                    'step'      => 1,
                    'data-unit' => 'px',
                    'data-deff' => 60
                )
            ));
        }
        

        {   /* ADDITIONAL */

            $the_panel = array(
                'title'             => __( 'Additional' , 'cannyon' ),
                'priority'          => 33,
                'capability'        => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $the_panel[ 'description' ] = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_section( 'mythemes-additional', $the_panel );

            /* LABEL "BLOG PAGE" */
            $wp_customize -> add_setting( 'mythemes-blog-title', array(
                'default'           => __( 'Blog', 'cannyon' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-blog-title', array(
                'label'             => __( 'Title for Blog Page', 'cannyon' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-blog-title',
                'type'              => 'text'
            ));

            /* ENABLE / DISABLE MYTHEMES GALLERY */
            $wp_customize -> add_setting( 'mythemes-gallery-style', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-gallery-style', array(
                'label'             => __( 'myThem.es Gallery Style', 'cannyon' ),
                'description'       => __( 'enable / disable myThem.es Gallery Style.', 'cannyon' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-gallery-style',
                'type'              => 'checkbox',
            ));

            /* ENABLE / DISABLE GOOGLE FONTS */
            $wp_customize -> add_setting( 'mythemes-google-fonts', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-google-fonts', array(
                'label'             => __( 'Load Google Fonts', 'cannyon' ),
                'description'       => __( 'enable / disable the Google Fonts. This option allow you to make the fonts style like in the 0.0.3 version.', 'cannyon' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-google-fonts',
                'type'              => 'checkbox',
            ));

            /* DISPLAY DEFAULT CONTENT */
            $wp_customize -> add_setting( 'mythemes-default-content', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-default-content', array(
                'label'             => __( 'Display default content', 'cannyon' ),
                'description'       => __( 'enable / disable default content from sidebars.', 'cannyon' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-default-content',
                'type'              => 'checkbox'
            ));

            /* DISPLAY TOP META */
            $wp_customize -> add_setting( 'mythemes-top-meta', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-top-meta', array(
                'label'             => __( 'Display top meta', 'cannyon' ),
                'description'       => __( 'enable / disable top meta from single posts ( all posts ).', 'cannyon' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-top-meta',
                'type'              => 'checkbox'
            ));

            /* DISPLAY BOTTOM META */
            $wp_customize -> add_setting( 'mythemes-bottom-meta', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-bottom-meta', array(
                'label'             => __( 'Display bottom meta', 'cannyon' ),
                'description'       => __( 'enable / disable bottom meta from single posts ( all posts ).', 'cannyon' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-bottom-meta',
                'type'              => 'checkbox'
            ));

            $fn_exists = function_exists( 'stats_get_csv' );

            if( $fn_exists ){
                /* DISPLAY NUMBER OF VIEWS */
                $wp_customize -> add_setting( 'mythemes-nr-views', array(
                    'default'           => true,
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_logic',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-nr-views', array(
                    'label'             => __( 'Display Number of Views', 'cannyon' ),
                    'description'       => __( 'enable / disable display number of views from blog.', 'cannyon' ),
                    'section'           => 'mythemes-additional',
                    'settings'          => 'mythemes-nr-views',
                    'type'              => 'checkbox'
                ));
            }

            /* HTML SUGGESTIONS */
            $wp_customize -> add_setting( 'mythemes-html-suggestions', array(
                'default'           => true,
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_logic',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-html-suggestions', array(
                'label'             => __( 'HTML Suggestions', 'cannyon' ),
                'description'       => __( 'enable / disable HTML Suggestions after comments form ( all posts ).', 'cannyon' ),
                'section'           => 'mythemes-additional',
                'settings'          => 'mythemes-html-suggestions',
                'type'              => 'checkbox'
            ));
        }


        {   /* LAYOUTS */

            $layout_panel = array(
                'title'             => __( 'Layout' , 'cannyon' ),
                'priority'          => 34,
                'capability'        => 'edit_theme_options'
            );

            $wp_customize -> add_panel( 'mythemes-layout-panel', $layout_panel );

            $sidebars   = array(
                'main'              => __( 'Main Sidebar' , 'cannyon' ),
                'front-page'        => __( 'Front Page Sidebar' , 'cannyon' ),
                'page'              => __( 'Page Sidebar' , 'cannyon' ),
                'post'              => __( 'Post Sidebar' , 'cannyon' ),
                'special-page'      => __( 'Special Page Sidebar' , 'cannyon' )
            );


            {   /* DEFAULT */

                $wp_customize -> add_section( 'mythemes-layout', array(
                    'title'             => __( 'Default' , 'cannyon' ),
                    'description'       => __( 'Default Layout is used for the next templates: Blog, Archives, Categories, Tags, Author and Search Results.' , 'cannyon' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-layout', array(
                    'default'           => 'right',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-layout', array(
                    'label'             => __( 'Layout' , 'cannyon' ),
                    'section'           => 'mythemes-layout',
                    'settings'          => 'mythemes-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'cannyon' ),
                        'full'  => __( 'Full Width', 'cannyon' ),
                        'right' => __( 'Right Sidebar', 'cannyon' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-sidebar', array(
                    'default'           => 'main',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'cannyon' ),
                    'section'           => 'mythemes-layout',
                    'settings'          => 'mythemes-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $sidebar_args[ 'description' ] = __( 'on the premium version you can create unlimited number of sidebars' , 'cannyon' );
                }

                $wp_customize -> add_control( 'mythemes-sidebar', $sidebar_args );
            }


            {   /* FRONT PAGE */

                $front_page_args =  array(
                    'title'             => __( 'Front Page' , 'cannyon' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                );

                if( get_option( 'show_on_front' ) == 'page' ){
                   $front_page_args[ 'description' ] = __( 'In order to use this option set you need to activate a staic page on Front Page from - "Static Front Page" tab' , 'cannyon' );
                }

                $wp_customize -> add_section( 'mythemes-front-page-layout', $front_page_args );

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-front-page-layout', array(
                    'default'           => 'right',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-front-page-layout', array(
                    'label'             => __( 'Layout' , 'cannyon' ),
                    'section'           => 'mythemes-front-page-layout',
                    'settings'          => 'mythemes-front-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'cannyon' ),
                        'full'  => __( 'Full Width', 'cannyon' ),
                        'right' => __( 'Right Sidebar', 'cannyon' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-front-page-sidebar', array(
                    'default'           => 'front-page',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $front_page_sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'cannyon' ),
                    'section'           => 'mythemes-front-page-layout',
                    'settings'          => 'mythemes-front-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $front_page_sidebar_args[ 'description' ] = __( 'On the premium version you can create unlimited number of sidebars' , 'cannyon' );
                }

                $wp_customize -> add_control( 'mythemes-front-page-sidebar', $front_page_sidebar_args);
            }
            

            {   /* SINGLE PAGE */

                $page_layout_args = array(
                    'title'             => __( 'Page' , 'cannyon' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $page_layout_args[ 'description' ]  = __( 'On the premium version for the each page you can overwrite the Layout options with the custom settings.' , 'cannyon' );
                }
                    
                $wp_customize -> add_section( 'mythemes-page-layout', $page_layout_args );

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-page-layout', array(
                    'default'           => 'full',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-page-layout', array(
                    'label'             => __( 'Layout' , 'cannyon' ),
                    'section'           => 'mythemes-page-layout',
                    'settings'          => 'mythemes-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'cannyon' ),
                        'full'  => __( 'Full Width', 'cannyon' ),
                        'right' => __( 'Right Sidebar', 'cannyon' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-page-sidebar', array(
                    'default'           => 'page',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $page_sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'cannyon' ),
                    'section'           => 'mythemes-page-layout',
                    'settings'          => 'mythemes-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $page_sidebar_args[ 'description' ] = __( 'On the premium version you can create unlimited number of sidebars' , 'cannyon' );
                }

                $wp_customize -> add_control( 'mythemes-page-sidebar', $page_sidebar_args );
            }
            

            {   /* SINGLE POST */

                $post_layout_args = array(
                    'title'             => __( 'Post' , 'cannyon' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $page_sidebar_args[ 'description' ] = __( 'On the premium version for the each post you can overwrite the Layout options with the custom settings.' , 'cannyon' );
                }

                $wp_customize -> add_section( 'mythemes-post-layout', $post_layout_args );

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-post-layout', array(
                    'default'           => 'right',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-post-layout', array(
                    'label'             => __( 'Layout' , 'cannyon' ),
                    'section'           => 'mythemes-post-layout',
                    'settings'          => 'mythemes-post-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'cannyon' ),
                        'full'  => __( 'Full Width', 'cannyon' ),
                        'right' => __( 'Right Sidebar', 'cannyon' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-post-sidebar', array(
                    'default'           => 'post',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $post_sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'cannyon' ),
                    'section'           => 'mythemes-post-layout',
                    'settings'          => 'mythemes-post-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $post_sidebar_args[ 'description' ] = __( 'On the premium version you can create unlimited number of sidebars' , 'cannyon' );
                }

                $wp_customize -> add_control( 'mythemes-post-sidebar', $post_sidebar_args );
            }
            

            {   /* SPECIAL PAGE */

                $special_page_layout_args = array(
                    'title'             => __( 'Special Page' , 'cannyon' ),
                    'panel'             => 'mythemes-layout-panel',
                    'capability'        => 'edit_theme_options'
                );

                if( mythemes_core::exists_premium() ){
                    $special_page_layout_args[ 'description' ] = __( 'On the premium version for each page you can overwrite the Layout options with custom settings.' , 'cannyon' );
                }

                $wp_customize -> add_section( 'mythemes-special-page-layout', $special_page_layout_args );

                /* SPECIAL PAGE */
                $wp_customize -> add_setting( 'mythemes-special-page', array(
                    'default'           => 2,
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_number',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-special-page', array(
                    'label'             => __( 'Special page' , 'cannyon' ),
                    'description'       => __( 'for selected page you can overwrite default page layout settings with special layout settings', 'cannyon' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page',
                    'type'              => 'dropdown-pages'
                ));

                /* LAYOUT */
                $wp_customize -> add_setting( 'mythemes-special-page-layout', array(
                    'default'           => 'right',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_layout',
                    'capability'        => 'edit_theme_options'
                ));
                $wp_customize -> add_control( 'mythemes-special-page-layout', array(
                    'label'             => __( 'Layout' , 'cannyon' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page-layout',
                    'type'              => 'select',
                    'choices'           => array(
                        'left'  => __( 'Left Sidebar', 'cannyon' ),
                        'full'  => __( 'Full Width', 'cannyon' ),
                        'right' => __( 'Right Sidebar', 'cannyon' )
                    )
                ));

                /* SIDEBAR */
                $wp_customize -> add_setting( 'mythemes-special-page-sidebar', array(
                    'default'           => 'special-page',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'mythemes_validate_sidebar',
                    'capability'        => 'edit_theme_options'
                ));
                $special_page_sidebar_args = array(
                    'label'             => __( 'Sidebar' , 'cannyon' ),
                    'section'           => 'mythemes-special-page-layout',
                    'settings'          => 'mythemes-special-page-sidebar',
                    'type'              => 'select',
                    'choices'           => $sidebars
                );

                if( mythemes_core::exists_premium() ){
                    $special_page_sidebar_args[ 'description' ] = __( 'On the premium version you can create unlimited number of sidebars' , 'cannyon' );
                }

                $wp_customize -> add_control( 'mythemes-special-page-sidebar', $special_page_sidebar_args );
            }
        }


        {   /* SOCIAL */

            $the_panel = array(
                'title'             => __( 'Social' , 'cannyon' ),
                'priority'          => 35,
                'capability'        => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $the_panel[ 'description' ] = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_section( 'mythemes-social', $the_panel );

            /* VIMEO */
            $wp_customize -> add_setting( 'mythemes-vimeo', array(
                'default'           => 'http://vimeo.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-vimeo', array(
                'label'             => __( 'Vimeo', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-vimeo',
                'type'              => 'url',
            ));

            /* TWITTER */
            $wp_customize -> add_setting( 'mythemes-twitter', array(
                'default'           => 'http://twitter.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-twitter', array(
                'label'             => __( 'Twitter', 'cannyon' ),
                'section'           => 'mythemes-social',
                'sanitize_callback' => 'esc_url_raw',
                'settings'          => 'mythemes-twitter',
                'type'              => 'url',
            ));

            /* SKYPE */
            $wp_customize -> add_setting( 'mythemes-skype', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-skype', array(
                'label'             => __( 'Skype', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-skype',
                'type'              => 'url',
            ));

            /* RENREN */
            $wp_customize -> add_setting( 'mythemes-renren', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-renren', array(
                'label'             => __( 'Renren', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-renren',
                'type'              => 'url',
            ));

            /* GITHUB */
            $wp_customize -> add_setting( 'mythemes-github', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-github', array(
                'label'             => __( 'Github', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-github',
                'type'              => 'url',
            ));

            /* RDIO */
            $wp_customize -> add_setting( 'mythemes-rdio', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-rdio', array(
                'label'             => __( 'Rdio', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-rdio',
                'type'              => 'url'
            ));

            /* LINKEDIN */
            $wp_customize -> add_setting( 'mythemes-linkedin', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-linkedin', array(
                'label'             => __( 'Linkedin', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-linkedin',
                'type'              => 'url',
            ));

            /* BEHANCE */
            $wp_customize -> add_setting( 'mythemes-behance', array(
                'default'           => 'http://behance.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-behance', array(
                'label'             => __( 'Behance', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-behance',
                'type'              => 'url',
            ));

            /* DROPBOX */
            $wp_customize -> add_setting( 'mythemes-dropbox', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-dropbox', array(
                'label'             => __( 'Dropbox', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-dropbox',
                'type'              => 'url',
            ));

            /* FLICKR */
            $wp_customize -> add_setting( 'mythemes-flickr', array(
                'default'           => 'http://flickr.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-flickr', array(
                'label'             => __( 'Flickr', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-flickr',
                'type'              => 'url',
            ));

            /* TUMBLR */
            $wp_customize -> add_setting( 'mythemes-tumblr', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-tumblr', array(
                'label'             => __( 'Tumblr', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-tumblr',
                'type'              => 'url',
            ));

            /* INSTAGRAM */
            $wp_customize -> add_setting( 'mythemes-instagram', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-instagram', array(
                'label'             => __( 'Instagram', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-instagram',
                'type'              => 'url',
            ));

            /* VKONTAKTE */
            $wp_customize -> add_setting( 'mythemes-vkontakte', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-vkontakte', array(
                'label'             => __( 'Vkontakte', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-vkontakte',
                'type'              => 'url',
            ));

            /* FACEBOOK */
            $wp_customize -> add_setting( 'mythemes-facebook', array(
                'default'           => 'http://facebook.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-facebook', array(
                'label'             => __( 'Facebook', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-facebook',
                'type'              => 'url',
            ));

            /* EVERNOTE */
            $wp_customize -> add_setting( 'mythemes-evernote', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-evernote', array(
                'label'             => __( 'Evernote', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-evernote',
                'type'              => 'url'
            ));

            /* FLATTR */
            $wp_customize -> add_setting( 'mythemes-flattr', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-flattr', array(
                'label'             => __( 'Flattr', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-flattr',
                'type'              => 'url',
            ));

            /* PICASA */
            $wp_customize -> add_setting( 'mythemes-picasa', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-picasa', array(
                'label'             => __( 'Picasa', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-picasa',
                'type'              => 'url',
            ));

            /* DRIBBBLE */
            $wp_customize -> add_setting( 'mythemes-dribbble', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-dribbble', array(
                'label'             => __( 'Dribbble', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-dribbble',
                'type'              => 'url',
            ));

            /* MIXI */
            $wp_customize -> add_setting( 'mythemes-mixi', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-mixi', array(
                'label'             => __( 'Mixi', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-mixi',
                'type'              => 'url',
            ));

            /* STUMBLEUPON */
            $wp_customize -> add_setting( 'mythemes-stumbleupon', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-stumbleupon', array(
                'label'             => __( 'Stumbleupon', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-stumbleupon',
                'type'              => 'url',
            ));

            /* LASTFM */
            $wp_customize -> add_setting( 'mythemes-lastfm', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-lastfm', array(
                'label'             => __( 'Lastfm', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-lastfm',
                'type'              => 'url',
            ));

            /* GPLUS */
            $wp_customize -> add_setting( 'mythemes-gplus', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-gplus', array(
                'label'             => __( 'GPlus', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-gplus',
                'type'              => 'url',
            ));

            /* GOOGLE CIRCLES */
            $wp_customize -> add_setting( 'mythemes-google-circles', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-google-circles', array(
                'label'             => __( 'Google circles', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-google-circles',
                'type'              => 'url',
            ));

            /* PINTEREST */
            $wp_customize -> add_setting( 'mythemes-pinterest', array(
                'default'           => 'http://pinterest.com/#',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-pinterest', array(
                'label'             => __( 'Pinterest', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-pinterest',
                'type'              => 'url',
            ));

            /* SMASHING */
            $wp_customize -> add_setting( 'mythemes-smashing', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-smashing', array(
                'label'             => __( 'Smashing', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-smashing',
                'type'              => 'url'
            ));

            /* SOUNDCLOUD */
            $wp_customize -> add_setting( 'mythemes-soundcloud', array(
                'default'           => '',
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-soundcloud', array(
                'label'             => __( 'Soundcloud', 'cannyon' ),
                'section'           => 'mythemes-social',
                'settings'          => 'mythemes-soundcloud',
                'type'              => 'url',
            ));

            /* RSS */
            $wp_customize -> add_setting( 'mythemes-rss', array(
                'default'           => esc_url( get_bloginfo('rss2_url') ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'esc_url_raw',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-rss', array(
                'label'         => __( 'Rss', 'cannyon' ),
                'section'       => 'mythemes-social',
                'settings'      => 'mythemes-rss',
                'type'          => 'url',
            ));
        }

        {   /* OTHERS */

            $the_panel = array(
                'title'             => __( 'Others' , 'cannyon' ),
                'priority'          => 36,
                'capability'        => 'edit_theme_options'
            );

            if( mythemes_core::exists_premium() ){
                $the_panel[ 'description' ] = sprintf( __( 'Discover the differences between the Cannyon free WordPress theme and the Premium version. %s' , 'cannyon' ) , '<br/><br/><a href="' . esc_url( admin_url( '/themes.php?page=mythemes-cannyon-faq#mythemes-differences' ) ) . '">' . __( 'See the Differences' , 'cannyon' ) . ' &rarr;</a>' );
            }

            $wp_customize -> add_section( 'mythemes-others', $the_panel );

            /* CUSTOM CSS */
            $wp_customize -> add_setting( 'mythemes-custom-css', array(
                'default'           => '',
                'transport'         => 'refresh',
                'sanitize_callback' => 'mythemes_validate_css',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-custom-css', array(
                'label'             => __( 'Custom css', 'cannyon' ),
                'section'           => 'mythemes-others',
                'settings'          => 'mythemes-custom-css',
                'type'              => 'textarea',
            ));

            /* COPYRIGHT */
            $wp_customize -> add_setting( 'mythemes-copyright', array(
                'default'           => sprintf( __( 'Copyright &copy; 2015. Powered by %s.' , 'cannyon' ) , '<a href="http://wordpress.org/">WordPress</a>' ),
                'transport'         => 'postMessage',
                'sanitize_callback' => 'mythemes_validate_copyright',
                'capability'        => 'edit_theme_options'
            ));
            $wp_customize -> add_control( 'mythemes-copyright', array(
                'label'             => __( 'Copyright', 'cannyon' ),
                'description'       => __( 'You can change only the first side of copyright. With the premium version you can change all the footer text.' , 'cannyon' ),
                'section'           => 'mythemes-others',
                'settings'          => 'mythemes-copyright',
                'type'              => 'textarea',
            ));
        }
	}
 
	add_action( 'customize_register' , 'mythemes_customize_register' );

	function mythemes_customizer_live_preview()
	{
        $ver = mythemes_core::theme( 'version' );

    	wp_register_script( 'mythemes-themecustomizer', get_template_directory_uri() . '/media/_backend/js/customizer.js', array( 'jquery', 'customize-preview' ), $ver, true );
        wp_enqueue_script( 'mythemes-themecustomizer' );
	}

    function mythemes_customize_panel()
    {        
        $ver = mythemes_core::theme( 'version' );

        $mythemes_customize_panel = array(
            'range_reset_label' => __( 'Reset to Default', 'cannyon' )
        );

        if( mythemes_core::exists_premium() ){
            $mythemes_customize_panel[ 'premium_url' ] = esc_url( mythemes_core::theme( 'premium' ) );
        }

        wp_register_script( 'mythemes-customize-panel', get_template_directory_uri() . '/media/_backend/js/customize-panel.js', array( 'jquery' ), $ver, true );
        wp_localize_script( 'mythemes-customize-panel', 'mythemes_customize_panel', $mythemes_customize_panel );
        wp_enqueue_script( 'mythemes-customize-panel' );
    }

    add_action( 'customize_preview_init', 'mythemes_customizer_live_preview' );
    add_action( 'customize_controls_print_footer_scripts', 'mythemes_customize_panel' );

    /* FUNCTIONS FOR VALIDATE */
    function mythemes_validate_logic( $value )
    {
        $rett = true;

        if( absint( $value ) == 0 ){
            $rett = false;
        }

        return $rett;
    }

    function mythemes_validate_number( $value )
    {
        return absint( $value );
    }

    function mythemes_validate_layout( $value )
    {
        if( !in_array( $value , array( 'left' , 'full' , 'right' ) ) ){
            $value = 'right';
        }

        return $value;
    }

    function mythemes_validate_sidebar( $value )
    {
        if( !in_array( $value , array( 'main', 'front-page', 'page', 'post', 'special-page' ) ) ){
            $value = 'main';
        }

        return $value;
    }

    function mythemes_validate_copyright( $value )
    {
        return wp_kses( $value, array(
            'a' => array(
                'href'  => array(),
                'title' => array(),
                'class' => array(),
                'id'    => array()
            ),
            'br'        => array(),
            'em'        => array(),
            'strong'    => array(),
            'span'      => array()
        ));
    }

    function mythemes_validate_css( $value )
    {
        return stripslashes( strip_tags( $value ) );
    }

    remove_action( 'wpclubmanager_before_main_content', 'wpclubmanager_output_content_wrapper', 10);
    remove_action( 'wpclubmanager_after_main_content', 'wpclubmanager_output_content_wrapper_end', 10);

    add_action('wpclubmanager_before_main_content', 'my_theme_wrapper_start', 10);
    add_action('wpclubmanager_after_main_content', 'my_theme_wrapper_end', 10);

    function my_theme_wrapper_start() {
    echo '<section id="main">';
    }

    function my_theme_wrapper_end() {
    echo '</section>';
    }

    add_theme_support( 'wpclubmanager' );


?>