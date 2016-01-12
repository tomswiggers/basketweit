<?php
if( !class_exists( 'mythemes_setup' ) ){

class mythemes_setup
{
	static function support()
	{
		global $content_width;
    
        if( !isset( $content_width ) ) {
            $content_width = 1140; 
        }

        add_theme_support( 'content-width', 1140 );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );

        add_theme_support( 'custom-background', array(
            'default-color' => 'eceff4',
            'default-image' => ''
        ));

        add_image_size( 'mythemes-classic' , 1140 , 515 , true );

        load_theme_textdomain( 'cannyon' );
        load_theme_textdomain( 'cannyon' , get_template_directory() . '/media/ln' );
        load_child_theme_textdomain( 'cannyon' );
	}

	static function sidebars()
	{
        register_sidebar(array(
            'id'            => 'main',
            'name'          => __( 'Main Sidebar' , 'cannyon' ),
            'description'   => __( 'Main Sidebar - is used by default for next templates: Blog, Archives, Author, Categories, Tags and Search Results.' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        ));

        register_sidebar(array(
            'id'            => 'front-page',
            'name'          => __( 'Front Page Sidebar' , 'cannyon' ),
            'description'   => __( 'Front Page Sidebar - is used by default for Front Page template.' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        ));

        register_sidebar(array(
            'id'            => 'post',
            'name'          => __( 'Post Sidebar' , 'cannyon' ),
            'description'   => __( 'Post Sidebar - is used by default for single post template.' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        ));

        register_sidebar(array(
            'id'            => 'page',
            'name'          => __( 'Page Sidebar' , 'cannyon' ),
            'description'   => __( 'Page Sidebar - is used by default for page template.' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        ));

        register_sidebar(array(
            'id'            => 'special-page',
            'name'          => __( 'Special Page Sidebar' , 'cannyon' ),
            'description'   => __( 'Special Page Sidebar - by default is used for Special Page Layout.' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        ));

        /* HEADER SIDEBARS */
        register_sidebar(array(
            'id'            => 'front-page-header-first',
            'name'          => __( 'Header - First Front Page Sidebar' , 'cannyon' ),
            'description'   => __( 'Content for left front page header Sidebar' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="header-widget-title">',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'id'            => 'front-page-header-second',
            'name'          => __( 'Header - Second Front Page Sidebar' , 'cannyon' ),
            'description'   => __( 'Content for middle front page header Sidebar' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="header-widget-title">',
            'after_title'   => '</h3>'
        ));

        register_sidebar(array(
            'id'            => 'front-page-header-third',
            'name'          => __( 'Header - Third Front Page Sidebar' , 'cannyon' ),
            'description'   => __( 'Content for right front page header Sidebar' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="header-widget-title">',
            'after_title'   => '</h3>'
        ));

        /* FOOTER SIDEBARS */
        register_sidebar(array(
            'id'            => 'footer-first',
            'name'          => __( 'Footer - First Sidebar' , 'cannyon' ),
            'description'   => __( 'Content for first footer Sidebar' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="footer-widget-title">',
            'after_title'   => '</h5>'
        ));

        register_sidebar(array(
            'id'            => 'footer-second',
            'name'          => __( 'Footer - Second Sidebar' , 'cannyon' ),
            'description'   => __( 'Content for second footer Sidebar' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="footer-widget-title">',
            'after_title'   => '</h5>'
        ));

        register_sidebar(array(
            'id'            => 'footer-third',
            'name'          => __( 'Footer - Third Sidebar' , 'cannyon' ),
            'description'   => __( 'Content for third footer Sidebar' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="footer-widget-title">',
            'after_title'   => '</h5>'
        ));

        register_sidebar(array(
            'id'            => 'footer-fourth',
            'name'          => __( 'Footer - Fourth Sidebar' , 'cannyon' ),
            'description'   => __( 'Content for fourth footer Sidebar' , 'cannyon' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="footer-widget-title">',
            'after_title'   => '</h5>'
        ));
	}

	static function menus()
    {
        register_nav_menus(array(
            'header' => __( 'Header menu' , 'cannyon' )
        ));
    }
}

}   /* END IF CLASS EXISTS */
?>