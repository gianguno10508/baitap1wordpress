            <footer id="footer">
				<h3 class="sub-title">
                    Address Shop
                </h3>
                <h2 class="title">
                    Contact with us
                </h2>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59479.82971198365!2d106.15511549283394!3d21.29167162914006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31356dadb70fbfe5%3A0xd6dbe565b8b15e5c!2zVHAuIELhuq9jIEdpYW5nLCBC4bqvYyBHaWFuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1642663266176!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				<div class="content-footer">
					<div class="container">
						<div class="footer-logo logo justify-content-center">
                            <a href="">
                                <h1><?php bloginfo('name'); ?></h1>
                                <h3><?php bloginfo('description');?></h3>
                            </a>
                        </div>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<div class="main-menu-footer">
									<div id="nav-menu">
										<?php wp_nav_menu( 
											array( 
											'theme_location' => 'footer-menu', 
											'container' => 'false', 
											'menu_id' => 'footer-menu', 
											'menu_class' => 'footer-menu'
											) 
										); ?>
									</div>
									<div class="clear"></div>
								</div>
							</div>							
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<div class="main-menu-footer">
									<div id="nav-menu">
										<?php wp_nav_menu( 
											array( 
											'theme_location' => 'footer-menu', 
											'container' => 'false', 
											'menu_id' => 'footer-menu', 
											'menu_class' => 'footer-menu'
											) 
										); ?>
									</div>
									<div class="clear"></div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<?php get_sidebar('footer'); ?>
							</div>
						</div>					
					</div>
				</div>
                <div class="copyright">
                    <p>Copyright © 2022 <?php bloginfo('name'); ?> - All Rights Reserved</p>
                </div>
            </footer>
	    </div>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/libs/jquery-3.4.1.min.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/libs/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/main.js"></script>
        <script src="https://kit.fontawesome.com/45a3cadf75.js" crossorigin="anonymous"></script>
		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="IVy8vYxk"></script>
		<?php wp_footer(); ?>
	</body>
</html>