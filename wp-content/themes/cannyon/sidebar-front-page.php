<?php
	/* SIDEBAR */
    if ( dynamic_sidebar( 'front-page' ) ){
        /* IF NOT EMPTY */    
    }

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){
    	/* SEARCH */
        echo '<div class="widget widget_search">';
        get_template_part( 'searchform' );
        echo '</div>';
        
        echo '<div class="widget widget_text">';
        echo '<h4 class="widget-title">' . __( 'Default Content' , 'cannyon' ) . '</h4>';
        echo '<div class="textwidget">';
        echo '<p>' . __( 'You can hide all default content from sidebars if you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Customize &rsaquo; Additional and disable option "Display default content".' , 'cannyon' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>