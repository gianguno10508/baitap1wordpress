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
if(!function_exists('testwordpress_theme_setup')){
	function testwordpress_theme_setup(){
		/* Thiet lap textdomain */
		$language_folder = THEME_URL . '/languages';
		load_theme_textdomain('testwordpress','$language_folder');

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
		register_nav_menu('primary-menu', __('Primary Menu', 'testwordpress'));

		/* Tao sidebar */
		$sidebar = array(
			'name' => __('Main Sidebar', 'testwordpress'),
			'id' => 'main-sidebar',
			'description' => __('Default sidebar'),
			'class' => 'main-sidebar',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>'
		);
		register_sidebar($sidebar);

	}
	add_action( 'init', 'testwordpress_theme_setup');
}

/** Template functions */

if(!function_exists('test_wordpress_header')){
	function test_wordpress_header(){ ?>
			<div class="site-name"> 
				<?php
					if (is_home()) {
						printf('<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename'));				
					}else{
						printf('<p><a href="%1$s" title="%2$s">%3$s</a></p>',
						get_bloginfo('url'),
						get_bloginfo('description'),
						get_bloginfo('sitename'));									
					}
				 ?>
			</div>
			<div class="site-description"><?php bloginfo('description'); ?></div><?php
	}
}

/* Thiet lap menu */
if(!function_exists('test_wordpress_menu')){
	function test_wordpress_menu($menu){
		$menu = array(
			'theme_location' => $menu,
			'container' => 'nav',
			'container_class' => $menu,
			'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
		);
		wp_nav_menu($menu);
	}
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

/*Ham hien thi thumbnail*/
if(!function_exists('testwordpress_thumbnail()')){
	function testwordpress_thumbnail($size){
		if(!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')): ?>
			<figure class="post-thumbnail"><?php the_post_thumbnail($size); ?></figure>
		<?php endif; ?>
		
 	<?php }
}

/* Ham hien thi tieu de */
if(!function_exists('testwordpress_entry_header')){
	function testwordpress_entry_header(){ ?>
		<?php if(is_single()): ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
		<?php else: ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<?php endif; ?>
	<?php }
}

/* Ham hien thi post, tac gia... */
if (!function_exists('testwordpress_entry_meta')) {
	function testwordpress_entry_meta(){ ?>
		<?php if(!is_page()): ?>
			<div class="entry-meta">
				<?php 
				printf(__('<span class="author">Posted by %1$s','testwordpress'),
				get_the_author());
				printf(__('<span class="date-published"> at %1$s', 'testwordpress'),
				get_the_date());
				printf(__('<span class="category"> in %1$s', 'testwordpress'),
				get_the_category_list(','));
				if(comments_open()):
					echo '<span class="meta-reply">';
					comments_popup_link(
						__('Leave a comment', 'testwordpress'),
						__('One comment', 'testwordpress'),
						__('% comments', 'testwordpress'),
						__('Read all comments', 'testwordpress')
					);
					echo '</span>';
				endif;
				?>
			</div>
		<?php endif; ?>
	<?php }
}

/* Ham hien thi noi dung cua post/page */
if(!function_exists('testwordpress_entry_content')){
	function testwordpress_entry_content(){
		if(!is_single() && !is_page()){
			the_excerpt();
		}else{
			the_content();
			$link_pages = array(
				'before' => __('<p>Page: ', 'testwordpress'),
				'after' => '</p>',
				'nextpagelink' => __('Next Page', 'testwordpress'),
				'previouspagelink' => __('Previous Page', 'testwordpress')
			);
			wp_link_pages($link_pages);
		}
	}
}

/* Read more*/
function testwordpress_readmore(){
	return '<a class="read-more" href="' .get_permalink(get_the_ID()) . '">'.__('...[Read More]', 'testwordpress'). '</a>';
}
add_filter('excerpt_more', 'testwordpress_readmore');

/** Hien thi tag **/
if(!function_exists('testwordpress_entry_tag')){
	function testwordpress_entry_tag(){
		if (has_tag()):
			echo '<div class="entry-tag">';
			printf(__('Tagged in %1$S','testwordpress'), get_the_tag_list(',', ','));
			echo '</div>';
		endif;
	}
}

/* Nhung file style.css */
function testwordpress_style(){
	wp_register_style('main-style', get_template_directory_uri() . "/style.css", 'all');
	wp_enqueue_style('main-style');
	wp_register_style('reset-style', get_template_directory_uri() . "/reset.css", 'all');
	wp_enqueue_style('reset-style');

	//superfish menu
	wp_register_style('superfish-style', get_template_directory_uri() . "/superfish.css", 'all');
	wp_enqueue_style('superfish-style');
	wp_register_script('superfish-script', get_template_directory_uri(). "/superfish.js", array('jquery'));
	wp_enqueue_script('superfish-script');

	//custom script
	wp_register_script('custom-script', get_template_directory_uri(). "/custom.js", array('jquery'));
	wp_enqueue_script('custom-script');
}
add_action('wp_enqueue_scripts','testwordpress_style');