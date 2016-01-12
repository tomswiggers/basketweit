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
                                    <li><?php _e( 'Author' , 'cannyon' ); ?></li>
                                    <li></li>
                                </ul>
                            </nav>
                            <h1><?php  echo esc_html( get_the_author_meta( 'display_name' , $post-> post_author ) ) ?></h1>
                        </div>

                        <div class="col-sm-4 col-md-3 col-lg-3 mythemes-author-avatar">
                            <div class="author-details">
                                <?php echo get_avatar( $post -> post_author, 68, get_template_directory_uri() . '/media/img/default-avatar-68.png' ); ?>
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