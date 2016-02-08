<?php
	/* SIDEBAR */
    if ( dynamic_sidebar( 'footer-second' ) ){
        /* IF NOT EMPTY */    
    }

    else if( (bool)get_theme_mod( 'mythemes-default-content', true ) ){
        echo '<div class="widget widget_text">';
        echo '<h5>' . __( 'Address' , 'cannyon' ) . '</h5>';
        echo '<div class="textwidget">' . sprintf( __( '1 Infinite Loop %s Cupertino, CA 95014 %s United States' , 'cannyon' ) , '<br/>' , '<br/>' ) . '</div>';
        echo '</div>';
    }
?>