<?php
    /* SIDEBAR */
    if ( dynamic_sidebar( 'special-page' ) ){
        /* IF NOT EMPTY */    
    }

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){
        echo '<div class="widget widget_text">';
        echo '<h4 class="widget-title">' . __( 'Contact Us' , 'cannyon' ) . '</h4>';
        echo '<div class="textwidget">';
        echo sprintf( __( 'facebook: %s' , 'cannyon' ) , ' <a href="#">https://facebook.com/#</a>' ) . '<br>';
        echo sprintf( __( 'direct: %s' , 'cannyon' ) , ' <a href="#">http://your-website.com/#</a>' ) . '<br>';
        echo '</div>';
        echo '</div>';

        echo '<div class="widget widget_text">';
        echo '<h4 class="widget-title">' . __( 'Working Hours' , 'cannyon' ) . '</h4>';
        echo '<div class="textwidget">';
        echo '08:00 - 17:00<br/>';
        echo __( 'Monday to Friday' , 'cannyon' );
        echo '</div>';
        echo '</div>';

        echo '<div class="widget widget_text">';
        echo '<h4 class="widget-title">' . __( 'Address' , 'cannyon' ) . '</h4>';
        echo '<div class="textwidget">';
        echo '1 Infinite Loop<br/>Cupertino, CA 95014, USA';
        echo '</div>';
        echo '</div>';
    }
?>