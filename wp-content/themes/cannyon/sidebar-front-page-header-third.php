<?php
    /* SIDEBAR */
    if ( dynamic_sidebar( 'front-page-header-third' ) ){
        /* IF NOT EMPTY */    
    }

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){
        echo '<div class="widget widget_text">';
        echo '<div class="textwidget">';
        echo '<h3>' . __( 'Responsive Layout' , 'cannyon' ) . '</h3>';
        echo '<p>' . __( 'We haven\'t forgotten about responsive layout. With Cannyon free WordPress theme, you can create a website with full mobile support.' , 'cannyon' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>