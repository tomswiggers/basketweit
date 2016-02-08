<?php
    $bg_color       = esc_attr( '#' . get_background_color() );
    $hd_bkg_color   = esc_attr( get_theme_mod( 'header-background-color', '#343b43' ) );
    $bkg            = esc_url( get_theme_mod( 'background_image' ) );
?>

<style type="text/css">

    /* HEADER */
    body{
        background-color: <?php echo esc_attr( $hd_bkg_color ); ?>;
    }

    /* BACKGROUND IMAGE */
    body div.content.main-content{

    <?php
        if( !empty( $bkg ) ){
    ?>
            background-image: url(<?php echo $bkg; ?>);
            background-repeat: <?php echo esc_attr( get_theme_mod( 'background_repeat' , 'repeat' ) ); ?>;
            background-position: <?php echo esc_attr( get_theme_mod( 'background_position_x' , 'center' ) ); ?>;
            background-attachment: <?php echo esc_attr( get_theme_mod( 'background_attachment' , 'scroll' ) ); ?>;
    <?php
        }
    ?>
    }

    /* BREADCRUMBS */
    div.mythemes-page-header{
        padding-top: <?php echo absint( get_theme_mod( 'mythemes-breadcrumbs-space', 60 ) ); ?>px;
        padding-bottom: <?php echo absint( get_theme_mod( 'mythemes-breadcrumbs-space', 60 ) ); ?>px;
    }

</style>

<style type="text/css" id="mythemes-custom-style-background">

    /* BACKGROUND COLOR */
    body div.content.main-content{
        background-color: <?php echo $bg_color; ?>;
    }
</style>


<?php
    /* SITE COLORS */
    /* FIRST SITE COLOR */
?>
<style type="text/css" id="mythemes-color-1" media="all">
    <?php $cl1 = get_theme_mod( 'mythemes-color-1', '#26ad60' ); ?>
    article a.more-link,
    body.single section div.post-meta-tags span,
    body.single section div.post-meta-tags a:hover,
    div.pagination nav a:hover,
    div.mythemes-paged-post > a:hover > span,
    div.error-404-search button,
    div.comments-list div.mythemes-comments > ol li.comment header span.comment-meta span.comment-replay a:hover,
    div.comment-respond h3.comment-reply-title small a,
    .mythemes-button.second,
    .header-button-wrapper a.btn.first-btn.header-button,
    div.mythemes-topper div.mythemes-header-antet button.btn-collapse,

    div.widget_search button[type="submit"],
    div.widget_post_tags div.tagcloud a:hover,
    div.widget_tag_cloud div.tagcloud a:hover{
        background-color: <?php echo esc_attr( $cl1 ); ?>;
    }

    @media ( min-width: 1025px ) {
        div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li.current-menu-ancestor > a,
        div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li.current-menu-item > a,
        div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li > ul:before,
        div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li > ul::before{
            background-color: <?php echo esc_attr( $cl1 ); ?>;
        }

        div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li > ul:after,
        div.mythemes-topper nav.header-menu ul.mythemes-menu-list > li > ul::after{
            border-color: <?php echo esc_attr( $cl1 ); ?>;
        }
    }

    @media ( max-width: 1024px ) {
        div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children span.menu-arrow:before,
        div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children span.menu-arrow::before {
            background-color: <?php echo esc_attr( $cl1 ); ?>;
        }
    }

    div.widget_post_tags div.tagcloud a,
    div.widget_tag_cloud div.tagcloud a{
        border-color: <?php echo esc_attr( $cl1 ); ?>;
    }

    a:hover,
    div.widget_post_tags div.tagcloud a,
    div.widget_tag_cloud div.tagcloud a{
        color: <?php echo esc_attr( $cl1 ); ?>;
    }
</style>


<?php
    /* SECOND SITE COLOR */
?>
<style type="text/css" id="mythemes-color-2" media="all">
    <?php $cl2 = get_theme_mod( 'mythemes-color-2', '#00aeef' ); ?>
    article a.more-link:hover,
    body.single section div.post-meta-tags span:hover,
    body.single section div.post-meta-tags a,
    div.error-404-search button:hover,
    div.comments-list div.mythemes-comments > ol li.comment header span.comment-meta span.comment-replay a,
    div.comment-respond h3.comment-reply-title small a:hover,
    .mythemes-button.second:hover,
    .header-button-wrapper a.btn.first-btn.header-button:hover,
    div.mythemes-topper div.mythemes-header-antet button.btn-collapse:focus,
    div.mythemes-topper div.mythemes-header-antet button.btn-collapse:hover,

    /* WIDGETS */
    div.widget_search button[type="submit"]:hover,
    div.widget_calendar table th,
    footer aside div.widget_calendar table th{
        background-color: <?php echo esc_attr( $cl2 ); ?>;
    }

    @media ( max-width: 1024px ) {
        div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children:hover > span.menu-arrow:before,
        div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children:hover > span.menu-arrow::before,
        div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children.collapsed > span.menu-arrow:before,
        div.mythemes-topper nav.header-menu div.menu-list-pre-wrapper div.menu-list-wrapper ul.mythemes-menu-list li.menu-item-has-children.collapsed > span.menu-arrow::before {
            background-color: <?php echo esc_attr( $cl2 ); ?>;
        }
    }

    a,
    div.widget a:hover,
    div.widget_rss ul li a.rsswidget:hover{
        color: <?php echo esc_attr( $cl2 ); ?>;
    }
</style>


<?php 
    /* HEADER ELEMENTS */
    /* CONTENT TITLE / DESCRIPTION */
?>

<style type="text/css" id="mythemes-header-title-color" media="all">
    div.mythemes-header a.header-title{
        color: <?php echo esc_attr( get_theme_mod( 'mythemes-header-title-color', '#ffffff' ) ); ?>;
    }
</style>

<style type="text/css" id="mythemes-header-description-color" media="all">
    <?php
        $hex    = esc_attr( get_theme_mod( 'mythemes-header-description-color', '#ffffff' ) );
        $rgba1  = 'rgba( ' . mythemes_tools::hex2rgb( $hex ) . ', 0.75 )';
        $rgba2  = 'rgba( ' . mythemes_tools::hex2rgb( $hex ) . ', 1.0 )';
    ?>
    div.mythemes-header a.header-description{
        color: <?php echo esc_attr( $rgba1 ); ?>;
    }
    div.mythemes-header a.header-description:hover{
        color: <?php echo esc_attr( $rgba2 ); ?>;
    }
</style>

<?php
    /* BUTTONS */
    /* FIRST BUTTON */
?>
<style type="text/css" id="mythemes-first-btn-bkg-color" media="all">
    <?php
        $cl1 = get_theme_mod( 'mythemes-first-btn-bkg-color' );
        if( !empty( $cl1 ) ){
    ?>
            .header-button-wrapper a.btn.first-btn.header-button{
                background-color: <?php echo esc_attr( $cl1 ); ?>;
            }
    <?php
        }
    ?>

    <?php
        $cl2 = get_theme_mod( 'mythemes-first-btn-bkg-h-color' );
        if( !empty( $cl2 ) ){
    ?>
            .header-button-wrapper a.btn.first-btn.header-button:hover{
                background-color: <?php echo esc_attr( $cl2 ); ?>;
            }
    <?php
        }
    ?>
</style>

<?php /* SECOND BUTTON */ ?>
<style type="text/css" id="mythemes-second-btn-bkg-color" media="all">
    .header-button-wrapper a.btn.second-btn.header-button{
        background-color: <?php echo esc_attr( get_theme_mod( 'mythemes-second-btn-bkg-color', '#636363' ) ); ?>;
    }

    .header-button-wrapper a.btn.second-btn.header-button:hover{
        background-color: <?php echo esc_attr( get_theme_mod( 'mythemes-second-btn-bkg-h-color', '#424242' ) ); ?>;
    }
</style>


<style type="text/css" id="mythemes-custom-css">
    <?php
        echo mythemes_validate_css( get_theme_mod( 'mythemes-custom-css' ) );
    ?>
</style>