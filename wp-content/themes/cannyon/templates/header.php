<?php
    global $wp_customize;

    /* BLOG TITLE & DESCRIPTION  */
    $title_label            = esc_html( get_theme_mod( 'mythemes-header-title-label' , __( 'Cannyon is a clean WordPress theme' , 'cannyon' ) ) );
    $description_label      = esc_html( get_theme_mod( 'mythemes-header-description-label' , __( 'freemium WordPress theme developed by myThem.es' , 'cannyon' ) ) );

    /* HEADER HEIGHT */
    $header_height          = absint( get_theme_mod( 'mythemes-header-height' , 400 ) );

    /* HEADER MASK */
    $header_mask_color      = esc_attr( get_theme_mod( 'mythemes-header-mask-color', '#000000' ) );
    $header_mask_opacity    = floatval( absint( get_theme_mod( 'mythemes-header-mask-opacity' , 75 ) ) / 100 );

    /* HEADER FIRST BUTTON */
    $first_btn_url          = esc_url( get_theme_mod( 'mythemes-first-btn-url', home_url( '#' ) ) );
    $first_btn_label        = esc_html( get_theme_mod( 'mythemes-first-btn-label', __( 'First Button', 'cannyon' ) ) );
    $first_btn_description  = esc_attr( get_theme_mod( 'mythemes-first-btn-description', __( 'first button link description...', 'cannyon' ) ) );

    /* HEADER SECOND BUTTON */
    $second_btn_url         = esc_url( get_theme_mod( 'mythemes-second-btn-url', home_url( '#' ) ) );
    $second_btn_label       = esc_html( get_theme_mod( 'mythemes-second-btn-label', __( 'Second Button', 'cannyon' ) ) );
    $second_btn_description = esc_attr( get_theme_mod( 'mythemes-second-btn-description', __( 'second button link description...', 'cannyon' ) ) );

    /* HEADER CUSTOMIZER */
    if( isset( $wp_customize ) ) {

        /* HEADER TITLE */
        $header_title       = true;
        $header_title_class = !(bool)get_theme_mod( 'mythemes-header-title', true ) ? 'hidden' : '';

        /* HEADER DESCRIPTION */
        $header_desc        = true;
        $header_desc_class  = !(bool)get_theme_mod( 'mythemes-header-description', true ) ? 'hidden' : '';

        /* HEADER FIRST BUTTON */
        $first_btn          = true;
        $first_btn_class    = !(bool)get_theme_mod( 'mythemes-first-btn', true ) ? 'hidden' : '';

        /* HEADER SECOND BUTTON */
        $second_btn         = true;
        $second_btn_class   = !(bool)get_theme_mod( 'mythemes-second-btn', true ) ? 'hidden' : '';
    }

    /* HEADER FRONTEND */
    else{

        /* HEADER TITLE */
        $header_title       = (bool)get_theme_mod( 'mythemes-header-title', true );
        $header_title_class = '';

        /* HEADER DESCRIPTION */
        $header_desc        = (bool)get_theme_mod( 'mythemes-header-description', true );
        $header_desc_class  = '';

        /* HEADER FIRST BUTTON */
        $first_btn          = (bool)get_theme_mod( 'mythemes-first-btn', true );
        $first_btn_class    = '';

        /* HEADER SECOND BUTTON */
        $second_btn         = (bool)get_theme_mod( 'mythemes-second-btn', true );
        $second_btn_class   = '';
    }
?>

<div class="mythemes-header parallax-container overflow-wrapper" style="height: <?php echo absint( $header_height ); ?>px;">

    <?php
        $header_img = esc_url( get_header_image() );

        if( !empty( $header_img ) ){
            echo '<div class="valign-cell-wrapper scene-wrapper">';
            echo '<div class="valign-cell">';

            echo '<div class="parallax" style="background-image: url(' . esc_url( $header_img ) . ');">';
            echo '<img src="' . esc_url( $header_img ) . '" alt="' . __( 'Header Image', 'cannyon' ) . ' - ' . esc_attr( $title_label ) . '" class="parallax-image"/>';
            echo '</div>';

            echo '</div>';
            echo '</div>';
        }
    ?>

    <div class="valign-cell-wrapper mythemes-header-mask" style="background: rgba( <?php echo mythemes_tools::hex2rgb( esc_attr( $header_mask_color ) ); ?>, <?php echo floatval( $header_mask_opacity ); ?> );">

        <!-- VERTICAL ALIGN CENTER -->
        <div class="valign-cell">
            
            <div class="row">
                <div class="col-lg-12">
                    <?php

                        /* HEADER TITLE */
                        if( $header_title ){
                            echo '<a class="header-title ' . esc_attr( $header_title_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $title_label . ' - ' . $description_label ) . '">';
                            echo esc_html( $title_label );
                            echo '</a>';
                        }

                        /* HEADER DESCRIPTION */
                        if( $header_desc ){
                            echo '<a class="header-description ' . esc_attr( $header_desc_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $title_label . ' - ' . $description_label ) . '">';
                            echo esc_html( $description_label );
                            echo '</a>';
                        }
                    ?>
                </div>
            </div>
                
        </div>
    </div>

    <div class="valign-bottom-cell-wrapper header-button-wrapper">
        <div class="valign-cell">
        <?php
            /* HEADER FIRST BUTTON */
            if( $first_btn ){
                echo '<a href="' . esc_url( $first_btn_url ) . '" class="btn first-btn header-button ' . esc_attr( $first_btn_class ) . '" title="' . esc_attr( $first_btn_description ) . '">';
                echo esc_html( $first_btn_label );
                echo '</a>';
            }

            /* HEADER SECOND BUTTON */
            if( $second_btn ){
                echo '<a href="' . esc_url( $second_btn_url ) . '" class="btn second-btn header-button ' . esc_attr( $second_btn_class ) . '" title="' . esc_attr( $second_btn_description ) . '">';
                echo esc_html( $second_btn_label );
                echo '</a>';
            }
        ?>
        </div>
    </div>
</div>