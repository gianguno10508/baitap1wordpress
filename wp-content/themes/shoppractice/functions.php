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

function my_custom_wc_theme_support(){
    add_theme_support('woocommerce');
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action('after_setup_theme', 'my_custom_wc_theme_support');

function initTheme(){
    //dang ky menu cho website
    register_nav_menu('header-main',__('Menu chính'));
    register_nav_menu('footer-menu',__('Menu footer'));

    //dang ky sidebar
    if (function_exists('register_sidebar')){
        register_sidebar(array(
            'name'=> 'Footer',
            'id' => 'sidebar_footer',
            'before_widget'  => '<div class="widget">',
            'after_widget'   => "</div>",
            'before_title'   => '<h3><i class="fa fa-bars"></i>',
            'after_title'    => "</h3>",
        ));
    }
    //view
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
}
add_action('init', 'initTheme'); 

//Remove trong woo
function custom_remove_action_woo(){
    remove_action('woocommerce_before_main_content','woocommerce_breadcrumb', 20);
}
add_action('init', 'custom_remove_action_woo');


function slider_post_type(){
    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Ảnh slider', //Tên post type dạng số nhiều
        'singular_name' => 'Ảnh slider' //Tên post type dạng số ít
    );
 
    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Ảnh slider', //Mô tả của post type
        'supports' => array(
            'title',
            'thumbnail',
            'editor',
        ), //Các tính năng được hỗ trợ trong post type
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => 'dashicons-images-alt2', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );
 
    register_post_type('slider', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên
 
}
add_action('init', 'slider_post_type');


/* Nhung file style.css */
function testwordpress_style(){
	wp_register_style('main-style', get_template_directory_uri() . "/css/main.css", 'all');
	wp_enqueue_style('main-style');
	wp_register_style('reset-style', get_template_directory_uri() . "/css/reset.css", 'all');
	wp_enqueue_style('reset-style');

   
    //font
    wp_register_style('font-roboto', "https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i", 'all');
	wp_enqueue_style('font-roboto');
    wp_register_style('font-dancing', "https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap", 'all');
	wp_enqueue_style('font-dancing');
    wp_register_style('font-marce', " https://fonts.googleapis.com/css2?family=Marcellus&display=swap", 'all');
	wp_enqueue_style('font-marce');
    wp_register_style('font-balsamiq', "https://fonts.googleapis.com/css2?family=Balsamiq+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap", 'all');
	wp_enqueue_style('font-balsamiq');


    //slick-slider
    wp_register_style('slick-style', get_template_directory_uri() . "/libs/slick-slider/slick.css", 'all');
    wp_enqueue_style('slick-style');
    wp_register_style('slick-theme', get_template_directory_uri() . "/libs/slick-slider/slick-theme.css", 'all');
    wp_enqueue_style('slick-theme');

    //fontawesome
    wp_register_style('fontawesome-style', get_template_directory_uri() . "/libs/font-awesome/css/font-awesome.min.css", 'all');
	wp_enqueue_style('fontawesome-style');
    wp_register_style('bootstrap-style', get_template_directory_uri() . "/libs/bootstrap/css/bootstrap.min.css", 'all');
	wp_enqueue_style('bootstrap-style');

	//custom script
	wp_register_script('custom-script', get_template_directory_uri(). "/js/main.js", array('jquery'));
	wp_enqueue_script('custom-script');

    //slick js
    wp_register_script('slick-script', get_template_directory_uri(). "/libs/slick-slider/slick.min.js", array());
    wp_enqueue_script('slick-script');
}
add_action('wp_enqueue_scripts','testwordpress_style');