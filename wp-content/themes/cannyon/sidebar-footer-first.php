<?php
	/* SIDEBAR */
    if ( dynamic_sidebar( 'footer-first' ) ){
        /* IF NOT EMPTY */    
    }

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){
        echo '<div class="widget widget_text">';
        echo '<h5>' . __( 'Cannyon' , 'cannyon' ) . '</h5>';
        echo '<div class="textwidget">';
        echo sprintf( __( 'It is a clean white WordPress theme %s with creative design and %s responsive layout.' , 'cannyon' ), '<br/>' , '<br/>' );
        echo '</div>';
        echo '</div>';
    }
?>