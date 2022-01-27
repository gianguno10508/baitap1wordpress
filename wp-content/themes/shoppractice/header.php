<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <title><?php the_title(); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="wrapper">
        <header>
            <div class="topbar-section-header">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-auto col-12">
                            <p>Free shipping for orders over $59 !</p>
                        </div>
                        <div class="col-auto d-none d-md-block">
                            <a href="#">
                                <i class="fas fa-map-marker-alt"></i>
                                <p>Shop location</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-section">
                <div class="container">
                    <div class="row row-cols-lg-3 align-items-center">
                        <div class="col">English</div>
                        <div class="col">
                            <div class="header-logo logo justify-content-center">
                                <a href="<?php bloginfo('url'); ?>">
                                    <h1><?php bloginfo('name'); ?></h1>
                                    <h3><?php bloginfo('description');?></h3>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="header-tools justify-content-end">
                                <ul>
                                    <li><a href="<?php bloginfo('url') ?>/tai-khoan"><i class="fas fa-user"></i></a></li>
                                    <li><a href="#"><i class="fas fa-search"></i></a></li>
                                    <li><a href="#"><i class="far fa-heart"></i></a></li>
                                    <li><a href="<?php bloginfo('url') ?>/gio-hang"><i class="fas fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-menu">
                <div class="container">
				    <div class="main-menu-header">
						<div id="nav-menu">
						    <?php wp_nav_menu( 
							    array( 
								'theme_location' => 'header-main', 
								'container' => 'false', 
								'menu_id' => 'header-main', 
								'menu_class' => 'header-main'
                                ) 
                            ); ?>
                        </div>
						<div class="clear"></div>
					</div>
                </div>
            </div>
        </header>
       <div class="banner">
            <?php if(!is_single()): ?>
                <?php if(!is_home()): ?>
                    <?php get_template_part('banner'); ?>
                <?php endif;?>
            <?php endif; ?>
            <?php if(!is_home()): ?>
                <div class="breadcrumbs">
                    <div class="container">
                        <?php
                            if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb('
                            <p id="breadcrumbs">','</p>');
                            }
                        ?>
                    </div>
                </div>
            <?php endif;?>
       </div>
	

