<?php
    /* SIDEBAR */
    if ( dynamic_sidebar( 'footer-fourth' ) ){
        /* IF NOT EMPTY */    
    }

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){
        echo '<div class="widget widget_text">';
        echo '<h5>' . __( 'Working Hours' , 'cannyon' ) . '</h5>';
        echo '<div class="textwidget">';
        echo __( 'Monday to Friday' , 'cannyon' ) . '<br/>';
        echo '08:00 - 17:00';
        echo '</div>';
        echo '</div>';
    }
?>