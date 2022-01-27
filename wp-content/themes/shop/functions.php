<?php 
function my_custom_wc_theme_support(){
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'my_custom_wc_theme_support');
function initTheme(){
    //dang ky menu cho website
    register_nav_menu('header-top',__('Menu top'));
    register_nav_menu('header-main',__('Menu chính'));
    register_nav_menu('footer-menu',__('Menu footer'));

    //dang ky sidebar
    if (function_exists('register_sidebar')){
        register_sidebar(array(
            'name'=> 'Cột bên',
            'id' => 'sidebar',
            'before_widget'  => '<div class="widget">',
            'after_widget'   => "</div>",
            'before_title'   => '<h3><i class="fa fa-bars"></i>',
            'after_title'    => "</h3>",
        ));
        register_sidebar(array(
            'name'=> 'Cột bên top',
            'id' => 'sidebar_top',
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
//Remove trong woo
function custom_remove_action_woo(){
    remove_action('woocommerce_before_main_content','woocommerce_breadcrumb', 20);
}
add_action('init', 'custom_remove_action_woo');


//Them action moi trong woo
// function add_image_head_product_list(){
//     echo '<img src="https://combomacbook.com/wp-content/uploads/2018/02/banner-web-1.png" alt="">';
// }
// add_action('woocommerce_before_main_content','add_image_head_product_list',40);
