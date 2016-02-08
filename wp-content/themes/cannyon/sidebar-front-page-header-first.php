<?php
    /* SIDEBAR */
    if ( dynamic_sidebar( 'front-page-header-first' ) ){
        /* IF NOT EMPTY */
    }

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){
        echo '<div class="widget widget_text">';
        echo '<div class="textwidget">';
        echo '<h3>' . __( 'Many Components' , 'cannyon' ) . '</h3>';
        echo '<p>' . __( 'There are a lot of different components that will help you to make a perfect suit for startup project with WordPress theme Cannyon.' , 'cannyon' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>