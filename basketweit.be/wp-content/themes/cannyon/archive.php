<?php get_header(); ?>

    <?php
        global $wp_query,$wp_customize;

        if( isset( $wp_customize ) ) {
            $breadcrumbs = true;
            $classes = !(bool)get_theme_mod( 'mythemes-breadcrumbs', true ) ? 'hidden' : '';
        }
        else{
            $breadcrumbs = (bool)get_theme_mod( 'mythemes-breadcrumbs', true );
            $classes = '';
        }

        if( $breadcrumbs ){
    ?>
            <div class="mythemes-page-header <?php echo esc_attr( $classes ); ?>">

                <div class="container">
                    <div class="row">

                        <div class="col-sm-8 col-md-9 col-lg-9">
                            <nav class="mythemes-nav-inline">
                                <ul class="mythemes-menu">
                                    <?php echo mythemes_breadcrumbs::home(); ?>

                                    <?php
                                        
                                        if ( is_day() ){
                                            $day    = get_the_date( );
                                            $m      = get_the_date( 'm' );
                                            $d      = get_the_date( 'd' );

                                            $month  = get_the_date( 'F' );
                                            $year   = get_the_date( 'Y' );
                                            $FY     = get_the_date( 'F Y' );

                                            echo '<li><a href="' . esc_url( get_year_link( $year ) ) . '" title="' . sprintf( __( 'Yearly archives - %s' , 'cannyon' ), esc_attr( $year ) ) . '">'  . esc_html( $year ) . '</a></li>';
                                            echo '<li><a href="' . esc_url( get_month_link( $year, $m ) ) . '" title="' . sprintf( __( 'Monthly archives - %s' , 'cannyon' ), esc_attr( $FY ) ) . '">'  . esc_html( $month ) . '</a></li>';
                                            echo '<li><time datetime="' . esc_attr( get_the_date( 'Y-m-d' ) ) . '">' . esc_html( $d ) . '</time></li>';

                                            $title  = __( 'Daily Archives' , 'cannyon' );

                                        }else if ( is_month() ){
                                            $month  = get_the_date( 'F' );
                                            $year   = get_the_date( 'Y' );

                                            echo '<li><a href="' . esc_url( get_year_link( $year ) ) . '" title="' . sprintf( __( 'Yearly archives - %s' , 'cannyon' ), esc_attr( $year ) ) . '">'  . esc_html( $year ) . '</a></li>';
                                            echo '<li><time datetime="' . esc_attr( get_the_date( 'Y-m-d' ) ) . '">' . esc_html( $month ) . '</time></li>';
                                            
                                            $title  = __( 'Monthly Archives' , 'cannyon' );

                                        }else if ( is_year() ){
                                            $year   = get_the_date( 'Y' );
                                            echo '<li><time datetime="' . esc_attr( get_the_date( 'Y-m-d' ) ) . '">'  . esc_html( $year ) . '</time></li>';

                                            $title  = __( 'Yearly Archives' , 'cannyon' );

                                        }else{
                                            $year   = __( 'Archives' , 'cannyon' );
                                            echo '<li>' . esc_html( $year ) . '</li>';
                                            $title  = $year;
                                        }
                                    ?>
                                    <li></li>
                                </ul>
                            </nav>
                            <h1><?php echo esc_html( $title ); ?></h1>
                        </div>

                        <div class="col-sm-4 col-md-3 col-lg-3 mythemes-posts-found">
                            <div class="found-details">
                                <?php echo mythemes_breadcrumbs::count( $wp_query ); ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
    <?php
        }
    ?>

    <div class="content main-content">
        <div class="container">
            <div class="row">

                <?php get_template_part( 'templates/loop' ); ?>

            </div>
        </div>
    </div>

<?php get_footer(); ?>