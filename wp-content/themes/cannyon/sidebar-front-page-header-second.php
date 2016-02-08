<?php
    /* SIDEBAR */
    if ( dynamic_sidebar( 'front-page-header-second' ) ){
        /* IF NOT EMPTY */    
    }

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){
        echo '<div class="widget widget_text">';
        echo '<div class="textwidget">';
        echo '<h3>' . __( 'Block Model' , 'cannyon' ) . '</h3>';
        echo '<p>' . __( 'With Cannyon free WordPress theme you can easily combine components in a variety ways for different design projects. It\'s easy!' , 'cannyon' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>