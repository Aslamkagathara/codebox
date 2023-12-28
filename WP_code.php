


/**
 * Enqueue scripts and styles.
 */
<?php

 include('inc/enqueue-script.php');
 include('inc/dd-function.php');
 include('inc/custom-posttype.php');
 ?>

 <?php

function ees_shipping_scripts() {
	wp_enqueue_style( 'ees_shipping-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'ees_shipping-style', 'rtl', 'replace' );
  // css file
	wp_enqueue_style('bootstrap-min-css' , get_template_directory_uri().'/assets/css/bootstrap.min.css' , array() , '' , false );
	wp_enqueue_style('fonts-css' , get_template_directory_uri().'/assets/fonts/font.css' , array() , '' , false );
  // Js file
	wp_enqueue_style('jquery');
	wp_enqueue_script('custom-js' , get_template_directory_uri().'/assets/js/custom.js' , array('jquery') , '' , true );

	wp_enqueue_script( 'ees_shipping-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ees_shipping_scripts' );

?>
<?php

// Register menu 

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ees_shipping' ),
			'menu-5' => esc_html__( 'Sidebar', 'ees_shipping' ),
			'menu-6' => esc_html__( 'footer_one', 'ees_shipping' ),
			'menu-7' => esc_html__( 'footer_two', 'ees_shipping' ),			
			'menu-8' => esc_html__( 'footer_three', 'ees_shipping' ),
		)
	);
?>
<?php

// Custom post code
function create_posttype() {
    register_post_type( 'our-team',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Our Team' ),
                'singular_name' => __( 'Our team' ),
				'all_items' => __( 'All Members'),
				'view_item'           => __( 'View Member' ),
				'add_new_item'        => __( 'Add New Member' ),
				'add_new'             => __( 'Add New' ),
				'edit_item'           => __( 'Edit Member' ),
				'update_item'         => __( 'Update Member' ),
				'search_items'        => __( 'Search Member' ),
				'not_found'           => __( 'Not Found' ),
				'not_found_in_trash'  => __( 'Not found in Trash' ),
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'our-team'),
            'show_in_rest' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', ),
			'menu_icon' => 'dashicons-groups',
  
        )
    );
}
add_action( 'init', 'create_posttype' );
?>
<?php

// Category post code
function add_custom_taxonomies() {
register_taxonomy('affiliate-category', 'affiliate-logos', array(
  'hierarchical' => true,
  'labels' => array(
    'name' => 'Categories',
    'singular_name' => 'Category',
    'search_items' =>  __( 'Search Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ),
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'menu_name' => __( 'Categories' ),
  ),
  // Control the slugs used for this taxonomy
  'rewrite'         => array(
    'slug'          => 'affiliate-category', 
    'with_front'    => false, 
    'hierarchical'  => true,
  ),
));

}
add_action( 'init', 'add_custom_taxonomies');
?>


<?php 
// ACF code for
    $about_us_title = get_field('about_us_title'); // for title
    $banner_main_title = get_field('banner_main_title'); // for title
    $banner_left_image = get_field('banner_left_image'); // for image
?>

<?php // for title
    if(!empty($about_us_title)){
        echo "<h5>".$about_us_title."</h5>";
    }
    if(!empty($banner_main_title)){
        echo "<h1>".$banner_main_title."</h1>";
    }
?>

<?php // For image
if(!empty($banner_left_image)){
    echo "<img src='".$banner_left_image['url']."' alt='".$banner_left_image['alt']."'>";
}
?>


<?php 
    $what_we_do_link = get_field('what_we_do_link'); // for link
?>
 <?php
  if(!empty($what_we_do_link)){ // for link
      echo "<a class='btn-yellow arrow-icon' href='".$what_we_do_link['url']."' target='".$what_we_do_link['target']."'>".$what_we_do_link['title']."</a>";
  }
?>