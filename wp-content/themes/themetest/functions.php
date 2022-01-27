<?php 
/**
  @Khai bao hang gia tri
      @ THEME_URL = lay duong dan thu muc theme
      @ CORE = lay duong dan cua thu muc / core
 **/
define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . "/core");    

/**
@ Nhung file /core/init.php
**/
require_once(CORE."/init.php");

/**
 @ Thiet lap chieu rong noi dung
**/
if(!isset($content_width)){
  $content_width = 620;
}

/**
@ Khai bao chuc nang cua theme
**/
if(!function_exists('myblog_theme_setup')){
  function myblog_theme_setup(){
    /* Thiet lap textdomain */
    $language_folder = THEME_URL . '/languages';
    load_theme_textdomain('myblog','$language_folder');

    /* Tu dong them link RSS len <head> */
    add_theme_support('automatic-feed-links');

    /* Them post thumbnail */
    add_theme_support('post-thumbnails');

    /* Post Format */
    add_theme_support('post-formats', array(
      'image',
      'video',
      'gallery',
      'quote',
      'link'
    ));

    /* Theme title*/
    add_theme_support('title-tag');

    /* Theme custom background */
    $default_backgroud = array(
      'default-color' => '#e8e8e8'
    );
    add_theme_support('custom-background', $default_backgroud);

    /* Theme menu */
    register_nav_menu('primary-menu', __('Primary Menu', 'myblog'));

    /* Tao sidebar */
    $sidebar = array(
      'name' => __('Main Sidebar', 'myblog'),
      'id' => 'main-sidebar',
      'description' => __('Default sidebar'),
      'class' => 'main-sidebar',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>'
    );
    register_sidebar($sidebar);

    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => false, 
    );
 
    add_theme_support( 'custom-logo', $defaults );
  }
  add_action( 'init', 'myblog_theme_setup');
}
/* Them logo */
// if(!function_exists('themename_custom_logo_setup')){
//   function themename_custom_logo_setup() {
//     $defaults = array(
//         'height'               => 100,
//         'width'                => 400,
//         'flex-height'          => true,
//         'flex-width'           => true,
//         'header-text'          => array( 'site-title', 'site-description' ),
//         'unlink-homepage-logo' => true, 
//     );
 
//     add_theme_support( 'custom-logo', $defaults );
//   }
// }
/** Template functions */

if(!function_exists('myblog_header')){
  function myblog_header(){ ?>
      <div class="header_left"> 
        <?php bloginfo('description'); ?>
      </div>
      <div class="header_right">
        <ul>
          <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
          <li><a href="#"><i class="fab fa-skype"></a></i></li>
        </ul>
      </div>
      <?php
  }
}
if(!function_exists('myblog_header_homelogo')){
  function myblog_header_homelogo(){?>

    <?php 
      printf('<h1><a href="%1$s" title="%2$s"><span>My</span> Blog</a></h1>',
      get_bloginfo('url'),
      get_bloginfo('description'));
    ?>
  <?php }
}
if(!function_exists('mylog_header_test_descript')){
  function mylog_header_test_descript(){?>
    <?php printf('<p>%1$s</p>',
        get_bloginfo('description'));
    ?>
    <?php
        $datapages = get_all_page_ids();
        foreach($datapages as $page){
          if (get_page_uri($page) == 'lien-he') {
            printf('<h5><a href="%1$s">%2$s</a></h5>',
            get_page_uri($page),
            __('PHEN PHEN'));            
          }
        }
  }
}

/* Thiet lap menu */
if(!function_exists('myblog_header_menu')){
  function myblog_header_menu($menu){
    $menu = array(
      'theme_location' => $menu,
      'container' => 'nav',
      'container_class' => $menu,
      'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
    );
    wp_nav_menu($menu);
  }
}

/* Thiet lap footer */
if(!function_exists('myblog_footer_content')){
  function myblog_footer_content(){?>
    <div class="myblog_footer_left">
      <div class="logo_footer">
        <?php 
          printf('<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
          get_bloginfo('url'),
          get_bloginfo('description'),
          get_bloginfo('sitename'));
        ?>
      </div>
      <div class="description_footer"><?php bloginfo('description'); ?></div>
    </div>
    <?php 
      $menu = array(
        'theme_location' => $menu,
        'container' => 'div',
        'container_class' => 'myblog_footer_right',
        'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
      );
    wp_nav_menu($menu);
    ?>
    <div class="myblog_category_footer">
        <?php 
            $categories = get_categories();
            foreach($categories as $category) {
               echo '<div class="col-md-4"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></div>';
            }
 
        ?>     
    </div>
            
  <?php }
}

// Tinh luot view

function setpostview($postID){
    $count_key ='views';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function getpostviews($postID){
    $count_key ='views';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}


// Bai viet noi bat
if(!function_exists('myblog_post_highlight')){
  function myblog_post_highlight(){
    $args = array(
      'post_status' => 'publish', // Chỉ lấy những bài viết được publish
      'post_type' => 'post', // Lấy những bài viết thuộc post, nếu lấy những bài trong 'trang' thì để là page 
      'showposts' => 3, // số lượng bài viết
      'meta_key' => 'views',
      'orderby' => 'meta_value_num',
    );
    $getposts = new WP_query($args);
    global $wp_query; $wp_query->in_the_loop = true;
    while ($getposts->have_posts()) : $getposts->the_post();?>
          <div id="xemnhieu-<?php the_ID();?>" <?php post_class(); ?>>
            <div class="entry-thumbnail">
                <?php myblog_thumbnail('thumbnail'); ?>
            </div>
            <div class="entry-header">
                <?php myblog_entry_header(); ?>
                <?php myblog_entry_meta(); ?>
            </div>
            <div class="entry-content">
                <?php myblog_entry_content(); ?>
                <?php (is_single() ? myblog_entry_tag() : ''); ?>
            </div>
          </div>
    <?php endwhile;

    wp_reset_postdata();
  }
}
/* Thiet lap content */
/* Hien thi thumbnail */
if(!function_exists('myblog_thumbnail')){
  function myblog_thumbnail($size){
    if(has_post_thumbnail() && !post_password_required() || has_post_format('image')): ?>
      <figure class="post-thumbnail"><?php the_post_thumbnail($size); ?></figure>
    <?php endif; ?>
    
  <?php }
}

/* Ham tao phan trang don gian*/
if(!function_exists('testwordpress_pagination()')){
	function testwordpress_pagination(){
		if($GLOBALS['wp_query']->max_num_pages < 2){
			return '';
		} ?>
		<nav class="pagination" role="navigation">
			<?php if(get_next_posts_link()): ?>
				<div class="pre"><?php next_posts_link( __('Older Posts', 'testwordpress')); ?></div>
			<?php endif; ?>
			<?php if(get_previous_posts_link()): ?>
				<div class="next"><?php previous_posts_link(__('Newest Posts', 'testwordpress')); ?></div>
			<?php endif; ?>
		</nav>
	<?php }
}

/* Ham hien thi tieu de */
if(!function_exists('myblog_entry_header')){
  function myblog_entry_header(){ ?>
    <?php if(is_single()): ?>
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
    <?php else: ?>
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    <?php endif; ?>
  <?php }
}
/* Ham hien thi post, tac gia... */
if (!function_exists('myblog_entry_meta')) {
  function myblog_entry_meta(){ ?>
    <?php if(!is_page()): ?>
      <div class="entry-meta">
        <?php 
        printf(__('<p class="category">Lượt xem: %1$s ', 'myblog'),
        getpostviews(get_the_id()));
        echo '</p>';
        printf(__('<span class="author">Posted by %1$s','myblog'),
        get_the_author());
        printf(__('<span class="date-published"> at %1$s', 'myblog'),
        get_the_date());
        printf(__('<span class="category"> in %1$s ', 'myblog'),
        get_the_category_list(','));
        if(comments_open()):
          echo '<span class="meta-reply">';
          comments_popup_link(
            __('Leave a comment', 'myblog'),
            __('One comment', 'myblog'),
            __('% comments', 'myblog'),
            __('Read all comments', 'myblog')
          );
          echo '</span>';
        endif;
        ?>
      </div>
    <?php endif; ?>
  <?php }
}

/* Ham hien thi noi dung cua post/page */
if(!function_exists('myblog_entry_content')){
  function myblog_entry_content(){
    if(!is_single() && !is_page()){
      the_excerpt();
    }else{
      the_content();
      $link_pages = array(
        'before' => __('<p>Page: ', 'myblog'),
        'after' => '</p>',
        'nextpagelink' => __('Next Page', 'myblog'),
        'previouspagelink' => __('Previous Page', 'myblog')
      );
      wp_link_pages($link_pages);
    }
  }
}

/* Read more*/
function myblog_readmore(){
  return '<a class="read-more" href="' .get_permalink(get_the_ID()) . '">'.__('...[Read More]', 'myblog'). '</a>';
}
add_filter('excerpt_more', 'myblog_readmore');

/** Hien thi tag **/
if(!function_exists('myblog_entry_tag')){
  function myblog_entry_tag(){
    if (has_tag()):
      echo '<div class="entry-tag">';
      printf(__('Tagged in %1$s','myblog'), get_the_tag_list(' ' , ' ,'));
      echo '</div>';
    endif;
  }
}

/*Nhung file css */
function myblog_style(){
  wp_register_style('main-style', get_template_directory_uri() . "/style.css", 'all');
  wp_enqueue_style('main-style');
  wp_register_style('reset-style', get_template_directory_uri() . "/reset.css", 'all');
  wp_enqueue_style('reset-style');
  wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );

  wp_enqueue_script( 'wpb-fa', 'https://kit.fontawesome.com/e40e535ff1.js', array(), '1.0.0', true );
    //superfish menu
  //custom script
  wp_register_script('custom-script', get_template_directory_uri(). "/custom.js", array('jquery'));
  wp_enqueue_script('custom-script');

  //slick css
  wp_register_style('slick-style', get_template_directory_uri() . "/css/slick.css", 'all');
  wp_enqueue_style('slick-style');
  wp_register_style('slick-theme', get_template_directory_uri() . "/css/slick-theme.css", 'all');
  wp_enqueue_style('slick-theme');
  wp_register_style('test', get_template_directory_uri() . "/fonts/slick.eot", 'all');
  wp_enqueue_style('test');
  wp_register_style('test1', get_template_directory_uri() . "/fonts/slick.woff", 'all');
  wp_enqueue_style('test1');
  wp_register_style('tes2t', get_template_directory_uri() . "/fonts/slick.ttf", 'all');
  wp_enqueue_style('test2');
  //slick js
  wp_register_script('slick2-script', get_template_directory_uri(). "/js/slick.min.js", array());
  wp_enqueue_script('slick2-script');
}

add_action('wp_enqueue_scripts','myblog_style');

if(!function_exists('get_images_from_media_library')){
  function get_images_from_media_library() {
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' =>'image',
        'post_status' => 'inherit',
        'posts_per_page' => 30,
        'orderby' => null
    );
    $query_images = new WP_Query( $args );
    $images = array();
    foreach ( $query_images->posts as $image) {
        $images[]= $image->guid;
    }
    return $images;
  }
}

if(!function_exists('display_images_from_media_library')){
  function display_images_from_media_library() {

    $imgs = get_images_from_media_library();
    $html = '<div class="slider variable-width" role="toolbar">';

    $html .= '<img src="' . $imgs[0] . '" alt="" />';
    $html .= '<img src="' . $imgs[1] . '" alt="" />';
    $html .= '<img src="' . $imgs[2] . '" alt="" />';
    // foreach($imgs as $img) {

    //     $html .= '<img src="' . $img . '" alt="" />';

    // }


    $html .= '</div>';

    return $html;

  }
}
