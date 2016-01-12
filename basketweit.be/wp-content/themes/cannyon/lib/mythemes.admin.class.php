<?php
if( !class_exists( 'mythemes_admin') ){

class mythemes_admin
{
    static function pageHeader( $pageSlug )
    {

        echo '<div class="mythemes-panel-header">';
        echo '<div class="mythemes-topper"></div>';
        echo '<div class="mythemes-middle mythemes-row">';

        echo '<div class="mythemes-col-3">';
        echo '<h1 class="mythemes-brand"><a href="' . mythemes_core::author( 'url' ) . '" title="' . mythemes_core::author( 'name' ) .' - ' . mythemes_core::author( 'description' ) . '">' . mythemes_core::author( 'name' ) . '</a></h1>';
        echo '</div>';

        echo '<div class="mythemes-col-9">';
        echo '<nav class="mythemes-nav">';

        echo '<ul class="mythemes-list mythemes-inline">';


        echo '<ul class="mythemes-list mythemes-inline special mythemes-free-theme">';

        /* WILL BE A TAB OR A PAGE WITH UPGRADE SYSTEM */
        if( mythemes_core::exists_premium() ){
            echo '<li>';
            echo '<a href="' . esc_url( mythemes_core::theme( 'premium' ) ) . '"><i class="mythemes-icon-publish"></i> <span>Upgrade to Premium</span></a>';
            echo '</li>';
        }
        
        echo '</ul>';

        echo '</nav>';
        echo '</div>';

        echo '<div class="clear clearfix"></div>';
        echo '</div>';
        echo '<div class="mythemes-poor"></div>';
        echo '</div>';


        /* BLANK SPACE */
        echo '<div class="mythemes-blank">';
        echo '<span class="mythemes-author-description">' . mythemes_core::author( 'description' ) . '</span>';
        echo '<a href="' . mythemes_core::theme( 'ThemeURI' ) . '"><strong>' . mythemes_core::theme( 'name' ) . '</strong> - ' . mythemes_core::version() . '</a>';
        echo '</div>';


        /* CONTENT */
        echo '<div class="mythemes-panel-wrapper">';
    }
    
    static function _pageContent( $pageSlug )
    {
        $pages  = mythemes_cfg::get_pages();
        $page   = $pages[ $pageSlug ];
        
        $cols   = $page[ 'cols' ];
        $boxes  = $page[ 'boxes' ];
        $sett   = $page[ 'sett' ];
        
        echo '<div class="mythemes-content">';
            
        /* SUBMIT FORM */
        if( !isset( $page[ 'update' ] ) || ( isset( $page[ 'update' ] ) && $page[ 'update' ] ) ){
            echo '<form method="post" action="?page=' . $pageSlug . '">';
        }

        /* COLUMNS */
        if( !empty( $cols ) ){
            foreach( $cols as $colName => $listBoxes ){

                /* COLUMN */
                echo '<div class="mythemes-col-6">';

                /* BOXES */
                foreach( $listBoxes as $boxSlug ){

                    /* FIELDS */
                    if( isset( $boxes[ $boxSlug ] ) ){

                        $boxes[ $boxSlug ][ 'slug' ] = $boxSlug;

                        echo mythemes_ahtml::box( $boxes[ $boxSlug ] , $sett );
                    }

                    /* IF NOT EXISTS BOX */
                    else{
                        $bt = debug_backtrace();
                        $caller = array_shift( $bt );

                        echo '<pre>' . $caller[ 'file' ] . ' : ' . $caller[ 'line' ];
                        echo '<br>Box not exist : [ ' . $boxSlug . ' ]';
                        echo '<br>';
                        print_r( $boxes );
                        echo '</pre>';
                    }
                    
                }

                echo '</div>';
            }
        }

        echo '<div class="clear"></div>';
            
        if( !isset( $page[ 'update' ] ) || ( isset( $page[ 'update' ] ) && $page['update'] ) ){

            echo '<div class="mythemes-footer">';
            echo '<a href="javascript:(function(){ if( confirm(\'' . __( 'Please confirm to reset options' , 'cannyon' ) . '\') ){ document.location.href=\'?page=' . $pageSlug . '&amp;reset=1\'; } })()" class="mythemes-button mythemes-reset-options" onclick="">' . __( 'Reset Options' , 'cannyon' ) . '</a>';
            echo '<input type="submit" class="mythemes-button mythemes-submit-options" value="' . __( 'Update Options' , 'cannyon' ) . '"/>';
            echo '</div>';

            echo '</form>';
        }

        echo '</div>';
        echo '</div>';
    }
    
    static function pageMenu()
    {
        $parent     = '';
        $pages      = mythemes_cfg::get_pages();
        $pageCB     = array( 'mythemes_admin', 'displayPage' );

        foreach( $pages as $slug => &$d ) {
            if( isset( $d[ 'menu' ] ) ) {
                $m = $d[ 'menu' ];
                if( strlen( $parent ) == 0 ) {
                    add_theme_page(
                        $m[ 'label' ]                                           /* page_title   */
                        , $m[ 'label' ]                                         /* menu_title   */
                        , 'administrator'                                       /* capability   */
                        , $slug                                                 /* menu_slug    */
                        , $pageCB                                               /* function     */
                    );
                    $parent = $slug;
                }
            }
        }
    }

    static function displayPage()
    {   
        if( !isset( $_GET ) || !isset( $_GET[ 'page' ] ) ){
            wp_die( 'Invalid page name', 'cannyon' );
            return;
        }

        $pageSlug = $_GET[ 'page' ];

        echo '<div class="mythemes-admin-page">';

        echo self::pageHeader( $pageSlug );

        echo '</div>';

        $faqs = mythemes_cfg::get( 'faqs' );


        if( !empty( $faqs ) ){
            foreach( $faqs as $faq ){
                echo '<div class="mythemes-content">';
                echo '<div class="mythemes-box">';
                echo '<div class="mythemes-box-header">';
                echo '<h3>' . $faq[ 'title' ] . '</h3>';
                echo '</div>';
                echo '<div class="mythemes-box-content">';
                echo $faq[ 'content' ];
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }

        $diff = mythemes_cfg::get( 'diff' );

        if( !mythemes_core::exists_premium() ){
            return null;    
        }

        if( empty( $diff ) ){
            return null;
        }

        echo '<div id="mythemes-differences" class="mythemes-headline">';
        echo '<h1>' . __( 'Features &amp; Differences' , 'cannyon' ) . '</h1>';
        echo '<p><span>' . __( 'The difference between the free and the premium version.', 'cannyon' ) . '</span></p>';
        echo '</div>';

        
        if( mythemes_core::exists_premium() ){
            echo '<a href="' . esc_url( mythemes_core::theme( 'premium' ) ) . '">';
            echo '<img src="' . get_template_directory_uri() . '/media/_backend/img/cannyon.png"/ style="margin: 0px auto; display: block; max-width: 100%;">';
            echo '</a>';
        }

        echo '<div class="mythemes-features-diff-wrapper">';
        echo '<table class="mythemes-features-diff">';
        echo '<tbody>';

        echo '<tr>';
        echo '<th class="mythemes-feature">' . __( 'Features' , 'cannyon' ) . '</th>';
        echo '<th class="mythemes-free">' . __( 'Free' , 'cannyon' ) . '<div><small>' . __( 'current version' , 'cannyon' ) . '</small></div></th>';
        echo '<th class="mythemes-premium">' . __( 'Premium' , 'cannyon' ) . '<div><a href="' . esc_url( mythemes_core::theme( 'premium' ) ) . '"><small>' . __( 'upgrade to premium' , 'cannyon' ) . '</small></a></div></th>';
        echo '</tr>';

        foreach( $diff as $index => $d ){

            $free       = '';
            $premium    = '';

            if( is_string( $d[ 1 ] ) ){
                $free       = $d[ 1 ];
            }
            else if( absint( $d[ 1 ] ) > 1 ){
                $free       = absint( $d[ 1 ] );
            }
            else if( absint( $d[ 1 ] ) == 1 ){
                $free       = '<i class="mythemes-icon-ok-circle-1"></i>';
            }   
            else if( absint( $d[ 1 ] ) == 0 ){
                $free       = '<i class="mythemes-icon-cancel-circled-2"></i>';
            }

            if( is_string( $d[ 2 ] ) ){
                $premium    = $d[ 2 ];
            }
            else if( absint( $d[ 2 ] ) > 1 ){
                $premium    = absint( $d[ 2 ] );
            }
            else if( absint( $d[ 2 ] ) == 1 ){
                $premium    = '<i class="mythemes-icon-ok-circle-1"></i>';
            }   
            else if( absint( $d[ 2 ] ) == 0 ){
                $premium    = '<i class="mythemes-icon-cancel-circled-2"></i>';
            }

            echo '<tr>';
            echo '<td class="mythemes-feature">' . $d[ 0 ] . '</td>';
            echo '<td class="mythemes-free">' . $free . '</td>';
            echo '<td class="mythemes-free">' . $premium . '</td>';
            echo '</tr>';            
        }

        echo '</table>';

        echo '<a href="' . esc_url( mythemes_core::theme( 'premium' ) ) . '" target="_blank" class="mythemes-button mythemes-premium-upgrade mythemes-submit-options"><i class="mythemes-icon-publish"></i>' . __( 'Upgrade to Premium' , 'cannyon' ) . '</a>';

        echo '</div>';
    }
}

}	/* END IF CLASS EXISTS */
?>