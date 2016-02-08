<?php
    global $posts_total, $posts_index;
    
    $mythemes_layout = new mythemes_layout( );

    /* LEFT SIDEBAR */
    $mythemes_layout -> sidebar( 'left' );
?>

<!-- CONTENT -->
<section class="<?php echo $mythemes_layout -> classes(); ?> mythemes-classic">
<?php
    
    /* CONTENT WRAPPER */ 
    if( have_posts() ){
        $posts_total = count( $wp_query -> posts );
        $posts_index = 0;
        while( have_posts() ){
            $posts_index++;
            the_post();
            get_template_part( 'templates/views/classic' );
        }
    }
    else{
        echo '<h3>' . __( 'No results found' , 'cannyon' ) . '</h3>';
        if( is_search() ){
            echo '<p>' . __( 'We apologize, but we couldn\'t find anything matching your search request. Please try to search for a different term or topic.' , 'cannyon' ) . '</p>';
        }
        else{
            echo '<p>' . __( 'We apologize but this page, post or resource does not exist or can not be found.' , 'cannyon' ) . '</p>';
        }
    }

    /* PAGINATION */
    get_template_part( 'templates/pagination' );
?>
</section>

<?php
    /* LEFT SIDEBAR */
    $mythemes_layout -> sidebar( 'right' );
?>