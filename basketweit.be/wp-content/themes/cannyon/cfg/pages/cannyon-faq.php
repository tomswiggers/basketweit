<?php

$pages  = mythemes_cfg::get_pages();


$cols   = array();
$boxes  = array();
$sett   = array();


$pages[ 'mythemes-cannyon-faq' ] = array(
    'menu' => array(
        'label'     => __( 'Cannyon FAQ' , 'cannyon' )
    ),
    'cols'  => & $cols,
    'boxes' => & $boxes,
    'sett'  => & $sett
);


mythemes_cfg::set_pages( $pages );


$is_enb_fp  = get_option( 'show_on_front' ) == 'page';
$content    = array( 'left', 'full', 'right' );
$sidebars   = array(
    'main-sidebar'          => __( 'Main Sidebar' , 'cannyon' ),
    'front-page-sidebar'    => __( 'Front Page Sidebar' , 'cannyon' ),
    'page-sidebar'          => __( 'Default Page Sidebar' , 'cannyon' ),
    'post-sidebar'          => __( 'Default Post Sidebar' , 'cannyon' ),
    'special-page-sidebar'  => __( 'Special Page Sidebar' , 'cannyon' )
);

$sett[ 'author-link' ] = array(
    'type' => array(
        'validator' => 'copyright'
    )
);

mythemes_cfg::set_sett( array_merge( mythemes_cfg::get_sett() , $sett ) );
?>