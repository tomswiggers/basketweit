<?php 

/**********************Logo showcase Slider*************************/

function wplss_logo_showcase_post_types() {

	$sp_logoshowcase_labels =  apply_filters( 'sp_logo_showcase_slider_labels', array(
		'name'                => 'Logo Showcase',
		'singular_name'       => 'Logo Showcase',
		'add_new'             => __('Add New', 'logoshowcase'),
		'add_new_item'        => __('Add New Logo Showcase', 'logoshowcase'),
		'edit_item'           => __('Edit Logo Showcase', 'logoshowcase'),
		'new_item'            => __('New Logo Showcase', 'logoshowcase'),
		'all_items'           => __('All Logo Showcase', 'logoshowcase'),
		'view_item'           => __('View Logo Showcase', 'logoshowcase'),
		'search_items'        => __('Search Logo Showcase', 'logoshowcase'),
		'not_found'           => __('No Logo Showcase found', 'logoshowcase'),
		'not_found_in_trash'  => __('No Logo Showcase found in Trash', 'logoshowcase'),
		'parent_item_colon'   => '',
		'menu_name'           => __('Logo Showcase', 'logoshowcase'),
		'exclude_from_search' => true
	) );


	$sp_logoshowcase_args = array(
		'labels' 			=> $sp_logoshowcase_labels,
		'public' 			=> true,
		'menu_icon'   => 'dashicons-images-alt2',
		'publicly_queryable'		=> true,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'query_var' 		=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> true,
		'hierarchical' 		=> false,
		'supports' => array('title','thumbnail')
		
	);
	register_post_type( 'logoshowcase', apply_filters( 'sp_logoshowcase_post_type_args', $sp_logoshowcase_args ) );

}
add_action('init', 'wplss_logo_showcase_post_types');

/* Register Taxonomy */

add_action( 'init', 'wplss_logo_showcase_taxonomies');
function wplss_logo_showcase_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Category' ),
        'all_items'         => __( 'All Category' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Logo Category' ),

    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'wplss_logo_showcase_cat' ),

    );

    register_taxonomy( 'wplss_logo_showcase_cat', array( 'logoshowcase' ), $args );

}

/* Custom meta box for slider link */
function wplss_add_meta_box() {
		add_meta_box('custom-metabox',__( 'Add Link URL for Logo', 'link_textdomain' ),'wplss_box_callback','logoshowcase');
}
add_action( 'add_meta_boxes', 'wplss_add_meta_box' );
function wplss_box_callback( $post ) {
	wp_nonce_field( 'wplss_save_meta_box_data', 'wplss_meta_box_nonce' );
	$value = get_post_meta( $post->ID, 'wplss_slide_link', true );
	echo '<input type="url" id="wplss_slide_link" name="wplss_slide_link" value="' . esc_attr( $value ) . '" size="25" /><br />';
	echo 'ie http://www.google.com';
}
function wplss_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['wplss_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['wplss_meta_box_nonce'], 'wplss_save_meta_box_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'logoshowcase' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	if ( ! isset( $_POST['wplss_slide_link'] ) ) {
		return;
	}
	$link_data = sanitize_text_field( $_POST['wplss_slide_link'] );
	update_post_meta( $post_id, 'wplss_slide_link', $link_data );
}
add_action( 'save_post', 'wplss_save_meta_box_data' );

/*
 * Add [logoshowcase limit ="-1"] shortcode
 *
 */

function wplss_logoshowcase_shortcode( $atts) {
	
	extract(shortcode_atts(array(
		"limit" => '',
		"cat_id" => '',
		"cat_name" => '',
		"slides_column" => '',
		"slides_scroll" => '',
		"dots" => '',
		"arrows" => '',
		"autoplay" => '',
		"autoplay_interval" => '',
		"speed" => '',
		"center_mode" => '',
		"loop" => '',
		"link_target" => '',
		"show_title" => '',
		"image_size" => '',
		
	), $atts));
	
	// Define limit
	if( $limit ) { 
		$posts_per_page = $limit;
             
	} else {
		$posts_per_page = '-1';
	}
	// Define limit
	if( $cat_id ) { 
		 $cat = $cat_id; 
	} else {
		$cat = '';
	}
	
	if( $cat_name ) { 
		$showcase_cat_name = $cat_name; 
	} else {
		$showcase_cat_name = '';
	}
	
	if( $slides_column ) { 
		$showcase_slides_column = $slides_column; 
	} else {
		$showcase_slides_column = '4';
	}
	
	if( $slides_scroll ) { 
		$showcase_slides_scroll = $slides_scroll; 
	} else {
		$showcase_slides_scroll = '1';
	}
	
	if( $dots ) { 
		$showcase_dots = $dots; 
	} else {
		$showcase_dots = 'true';
	}
	
	if( $arrows ) { 
		$showcase_arrows = $arrows; 
	} else {
		$showcase_arrows = 'true';
	}
	
	if( $autoplay ) { 
		$showcase_autoplay = $autoplay; 
	} else {
		$showcase_autoplay = 'true';
	}
	
	if( $autoplay_interval ) { 
		$showcase_autoplayInterval = $autoplay_interval; 
	} else {
		$showcase_autoplayInterval = '2000';
	}
	
	if( $speed ) { 
		$showcase_speed = $speed; 
	} else {
		$showcase_speed = '300';
	}
	if( $center_mode ) { 
		$showcase_center_mode = $center_mode; 
	} else {
		$showcase_center_mode = 'false';
	}
	if( $loop ) { 
		$showcase_loop = $loop; 
	} else {
		$showcase_loop = 'true';
	}
	if( $link_target ) { 
		$linkTarget = $link_target; 
	} else {
		$linkTarget = '';
	}
	if( $show_title ) { 
		$showTitle = $show_title; 
	} else {
		$showTitle = 'false';
	}
	if( $image_size ) { 
		$sliderimage_size = $image_size; 
	} else {
		$sliderimage_size = 'original';}	

	ob_start();

	$post_type 		= 'logoshowcase';
	$orderby 		= 'post_date';
	$order 			= 'DESC';
	       			
	 $args = array ( 
            'post_type'      => $post_type, 
            'orderby'        => $orderby, 
            'order'          => $order,
            'posts_per_page' => $posts_per_page,  
           
            );
	if($cat != ""){
            	$args['tax_query'] = array( array( 'taxonomy' => 'wplss_logo_showcase_cat', 'field' => 'term_id', 'terms' => $cat) );
            }        
      $query = new WP_Query($args);
	
	$post_count = $query->post_count;?>
 
 <?php if($showcase_cat_name != '') { ?>
	<h2><?php echo $showcase_cat_name; ?> </h2>	
	<?php	} ?>
<ul class="logo_showcase showcase_<?php echo $cat; ?> <?php if($showcase_center_mode == "true") { echo 'center'; } else { echo 'nocenter'; } ?>"> 
<?php
		  while ($query->have_posts()) : $query->the_post();
		 ?>			
			<li> 
			<?php $logourl = get_post_meta( get_the_ID(),'wplss_slide_link', true ); 
			if ($logourl != '') { ?>
			<a href="<?php echo $logourl; ?>" <?php if($linkTarget == 'blank') { ?> target="_blank" <?php } ?>>
				<?php if($sliderimage_size == '' || $sliderimage_size == 'original')  { 
						the_post_thumbnail('url'); 			 
					} elseif ($sliderimage_size == 'large') {			
						the_post_thumbnail('large'); 
					} elseif ( $sliderimage_size == 'medium') {
						the_post_thumbnail('medium'); 
					} elseif ( $sliderimage_size == 'thumbnail') {
						the_post_thumbnail('thumbnail'); 
					}  else {
						 the_post_thumbnail('url'); 			
					} ?>
				</a>
			<?php } 
				else 
				{ 
					if($sliderimage_size == '' || $sliderimage_size == 'original')  { 
						the_post_thumbnail('url'); 			 
					} elseif ($sliderimage_size == 'large') {			
						the_post_thumbnail('large'); 
					} elseif ( $sliderimage_size == 'medium') {
						the_post_thumbnail('medium'); 
					} elseif ( $sliderimage_size == 'thumbnail') {
						the_post_thumbnail('thumbnail'); 
					}  else {
						 the_post_thumbnail('url'); 			
					}
				}
				if($showTitle == "true") { ?> 	
				<div class="logo-title"><?php the_title(); ?></div>
				<?php } ?>
			</li>				
		<?php endwhile; ?>
	</ul>

	<?php wp_reset_query(); ?>

	<script>		
        jQuery(document).ready(function(){    
<?php if($showcase_center_mode == "true") { ?>		
             jQuery('.showcase_<?php echo $cat; ?>.center').slick({
				  <?php } else { ?>
				  jQuery('.showcase_<?php echo $cat; ?>.nocenter').slick({
			 <?php } ?>
             	 centerMode: <?php echo $showcase_center_mode; ?>,                 
  					dots: <?php echo $showcase_dots; ?>,
  					infinite: <?php echo $showcase_loop; ?>,
  					speed: <?php echo $showcase_speed; ?>,
  					slidesToShow: <?php echo $showcase_slides_column; ?>,
  					slidesToScroll: <?php echo $showcase_slides_scroll; ?>,
					autoplay: <?php echo $showcase_autoplay; ?>,
					autoplaySpeed: <?php echo $showcase_autoplayInterval; ?>,
					
					
  		responsive: [
    		{
    		  breakpoint: 1024,
    			  settings: {
     		      slidesToShow: 3,
        		  slidesToScroll: 2,
        		  infinite: true,
                  dots: true
                }
    },
    {
      breakpoint: 640,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
     ]
});

  });
    </script>
    
<?php


return ob_get_clean();}


add_shortcode("logoshowcase", "wplss_logoshowcase_shortcode");

// Manage Category Shortcode Columns

add_filter("manage_wplss_logo_showcase_cat_custom_column", 'wplss_logoshowcase_cat_columns', 10, 3);
add_filter("manage_edit-wplss_logo_showcase_cat_columns", 'wplss_logoshowcase_cat_manage_columns'); 
function wplss_logoshowcase_cat_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'logoshowcase_shortcode' => __( 'Logo Category Shortcode', 'logoshowcase' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
			);
    return $new_columns;
}

function wplss_logoshowcase_cat_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'faq_cat');
    switch ($column_name) {      

        case 'title':
            echo get_the_title();
        break;
        case 'logoshowcase_shortcode':        

             echo '[logoshowcase cat_id="' . $theme_id. '"]';
        break;

        default:
            break;
    }
    return $out;   

}