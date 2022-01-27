<!DOCTYPE html>
<html <?php language_attributes(); ?> />
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
	<div id="container">
		<div class="logo">
			<?php test_wordpress_header(); ?>
			<?php test_wordpress_menu('primary-menu'); ?>
		</div>
