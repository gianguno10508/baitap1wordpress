<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="header">
		<div class="head">
			<?php myblog_header(); ?>
		</div>
		<div id="logo">
<!-- 			<?php 
			   $custom_logo_id = get_theme_mod( 'custom_logo' );
			   $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				?>
			<img src="<?php echo $image[0]; ?>" alt=""> -->
			<div class="home-logo">
				<?php myblog_header_homelogo(); ?>
			</div>
			<?php myblog_header_menu('primary-menu'); ?>
		</div>
		<?php echo display_images_from_media_library(); ?>

		<div class="test">
			<h1>Test Blog</h1>
			<div class="test-descipt">
				<?php mylog_header_test_descript(); ?>
			</div>
		</div>
		<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
	</div>
	<div class="container">
