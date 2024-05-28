<!-- code start here -->

<!-- calling Footer -->
<?php get_footer(); ?>
<!-- Calling Header -->
<?php get_header(); ?>


 <!-- template part get in any pages -->
 <?
get_template_part( 'template-parts/common_banner');
?>

<?php get_header();  // for template calling 
/* Template Name: About  */
?>


<!-- Files no path -->
<img src="<?php echo get_template_directory_uri(); ?>/images/mindset.jpg" />

<!-- Main theme hoi tyare -->
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="" />

<!-- Child theme hoi tyare -->

<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ro-original-small.png" />
<!-- CSS Path -->

<!--  background-image: url("../images/home_ca_min.jpg"); -->


<?php
/**
 * Enqueue scripts and styles.
 */
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

<!-- Calling admin logo -->
<?php

function site_logo_adminlogin() { 
?> 
<style type="text/css"> 
body.login div#login h1 a {
    background-image: url('<?php echo get_stylesheet_directory_uri()."/assets/images/mvs-admin-logo.png";?>'); 
    background-size: 150px;
    width: 150px;
    height: 145px;

} 
</style>
 <?php 
} 
add_action( 'login_enqueue_scripts', 'site_logo_adminlogin' );

add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
     return site_url();
}
?>


<!-- admin logo  -->
<?php
function ds_admin_login_logo() {
    $logo = get_field('logo','option'); //id return
    $img_url = wp_get_attachment_url($logo);
    ?>
<style type="text/css">
#login h1 a, .login h1 a {
background-image: url('<?php echo $img_url; ?>');
height:55px;
width:270px;
background-size: 270px 100px;
background-repeat: no-repeat;
padding-bottom: 45px;
}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'ds_admin_login_logo' );

add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
     return site_url();
}
?>



<!---------------------------------------  ACF code for ------------------------------------------------->
<?php 
    $about_us_title = get_field('about_us_title'); // for title 
    $banner_main_title = get_field('banner_main_title'); // for title
    $banner_left_image = get_field('banner_left_image'); // for image
?>
<!--  For title-->
<?php 
    if(!empty($about_us_title)){
        echo "<h5>".$about_us_title."</h5>";
    }
    if(!empty($banner_main_title)){
        echo "<h1>".$banner_main_title."</h1>";
    }
?>
<!--  For image -->
<?php 
if(!empty($banner_left_image)){
    echo "<img src='".$banner_left_image['url']."' alt='".$banner_left_image['alt']."'>";
}
?>

<!--  for link -->
<?php 
    $what_we_do_link = get_field('what_we_do_link'); 
?>
 <?php
  if(!empty($what_we_do_link)){ 
      echo "<a class='btn-yellow arrow-icon' href='".$what_we_do_link['url']."' target='".$what_we_do_link['target']."'>".$what_we_do_link['title']."</a>";
  }
?>

<!-- Different type of title calling  -->
<?php
  $page_title  = get_field( 'title' ); 
  $section_title  = get_field( 'section_title' ); 
  $banner_image = get_field( 'banner' );
?>
<h1><?php echo $page_title ?></h1>
<h3><?php echo $section_title ?></h3> <!-- Calling  feild name -->
<h3><?php echo get_field('field_64c8ef8d4da77'); ?></h3> <!-- Calling field key -->

<!-- Different type of Image calling  -->

<!--  Calling Image URL -->
<img src="<?php echo $banner_image ?>" alt="" class="image-bannner">  

<!--  Calling  Image array -->
<?php  if( $banner_image ) {
  echo wp_get_attachment_image($banner_image['ID'], 'full', false, array('class' => 'image-responsive') ); 
  } 
?> 

<!--  Calling Image id -->
<?php 
$size = 'full'; // (thumbnail, medium, large, full or custom size)
if( $banner_image ) {
    echo wp_get_attachment_image( $banner_image, $size );
} ?>


<!-- Calling Reapeter -->
<?php if( have_rows('image_slider') ): ?>
    <ul class="slides">
    <?php while( have_rows('image_slider') ): the_row(); 
          $image = get_sub_field( 'slide' );
          $link = get_sub_field( 'slide_btn' );
        ?>
        <li>
            <img src="<?php echo $image ?>" alt="" class="image-bannner">
            <p><?php the_sub_field('slide_title'); ?></p>
            <a href="<?php echo $link ?>"> Read more</a>
        </li>
    <?php endwhile; ?>
    </ul>
<?php endif; ?>


<!-- add new class in body base on condition -->
<?php 
function custom_body_class_fun($classes) {
    if (is_user_logged_in()) {
        $classes[] = 'login_user'; // your custom class name
    }
    return $classes;
}
add_filter('body_class', 'custom_body_class_fun'); ?>


<!-- post per page news Post wp query for post in function.phpfile  -->
<?php

function set_posts_per_page_for_towns_cpt( $query ) {
	if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'news' ) ) {
	  $query->set( 'posts_per_page', '9' );
	}
    //meta
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'news' ) ) {
      $query->set( 'meta_key', 'bcware_news_post_add_featured_stories' );
      $query->set( 'meta_value', 'yes' );
    }
  }
add_action( 'pre_get_posts', 'set_posts_per_page_for_towns_cpt' );

?>
<!--  SVG support -->
<?php
function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function ds_add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'ds_add_file_types_to_uploads');

?>

<!-- svg image code js -->
<?php

$(".main-logo img").each(function () {
var $img = jQuery(this);
var attributes = $img.prop("attributes");
var imgURL = $img.attr("src");
$.get(imgURL, function (data) {
var $svg = $(data).find('svg');
$svg = $svg.removeAttr('xmlns:a');
$.each(attributes, function() {
  $svg.attr(this.name, this.value);
});
$img.replaceWith($svg);
});
});

?>
<!--  dynamic year in footer -->
<?php 

// For Footer copyright year

function year_shortcode() {
    $year = date('Y');
    return $year;
}
add_shortcode('year', 'year_shortcode');


/*dynamic year */
function currentYear( $atts ){
  return date('Y');
}
add_shortcode( 'dynamic_year', 'currentYear' );
// year shortcode
function year_shortcode () {
    $year = date_i18n ('Y');
    return $year;
}
add_shortcode ('year', 'year_shortcode');
?>


<!-- common banner -->

<?php 
function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}
if(is_page())
{
    $id  = get_the_ID();

}
if(is_archive('faq') && is_post_type_archive('faq')){
    $id        = 197;
    $title     = get_the_title( 197 );
}
if(is_archive('testimonials') && is_post_type_archive('testimonials')){
    $id        = 201;
    $title     = get_the_title( 201 );
}
if(is_archive('team') && is_post_type_archive('team')){
    $id        = 133;
    $title     = get_the_title( 133 );
}
if(is_blog ()){
    $id        = 137;
    $title     = get_the_title( 137 );
}

$biziloans_banner_image        = get_field( 'biziloans_banner_image',$id ); 
?>
<!-- pagination  -->
<div class="blog_pagination">
  <nav class="navigation pagination">
      <?php
      global $wp_query;
      $max_num_page = $wp_query->max_num_pages;

      if ($max_num_page > 1){
          $current_page = max(1, get_query_var('paged'));
          echo paginate_links(array(
              'base'      => get_pagenum_link(1) . '%_%',
              'format'    => '/page/%#%',
              'current'   => $current_page,
              'total'     => $max_num_page,
              'prev_text' => '<-',
              'next_text' => '->'
          ));
      }
      ?>
  </nav>
</div>
<?php
  echo paginate_links(); 
                      
  // Previous/next page navigation.
  the_posts_pagination(array(
      'screen_reader_text' => __(' ', 'automonkey'),
      'prev_text'          => __('prev page', 'automonkey'),
      'next_text'          => __('Next Page', 'automonkey'),
      'before_page_number' => '',
  ));
?>


<!-- Template parts -->

<?php 
/* Template Name: About Us */ 

get_header();
custom_breadcrumbs(); 


get_template_part('template-parts/about-us/template' , 'about_benner');
get_template_part('template-parts/about-us/template' , 'about_middle_section');
get_template_part('template-parts/about-us/template' , 'about_bottom');


get_footer();

?>
