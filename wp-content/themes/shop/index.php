<?php get_header(); ?>
			<div id="content">
				<div class="container">
					<?php get_template_part('slider'); ?>
				</div>
				<div class="product-box">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 order-lg-0 order-1">
								<div class="sidebar">
									<?php get_sidebar(); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 order-lg-1 order-0">
								<div class="product-section">
									<h2 class="title-product">
										<a href="#" class="title">Sản phẩm nổi bật</a>
										<div class="bar-menu"><i class="fa fa-bars"></i></div>
										
										<div class="list-child">
											<ul>
												<?php
												$args = array(
													'type'      => 'product',
													'child_of'  => 0,
													'parent'    => '0',
													'taxonomy'	=> 'product_cat',
													'hide_empty'=> 0,
													'number'	=> 5
												);
												$categories = get_categories( $args );
												foreach ( $categories as $category ) { ?>
													<li><a href="<?php echo get_term_link($category->slug, 'product_cat');?>"><?php echo $category->name; ?></a></li>
												<?php } ?>
											</ul>
										</div>
										<div class="clear"></div>
									</h2>
									<div class="content-product-box">
										<div class="row">
										<?php
											$tax_query[] = array(
												'taxonomy' => 'product_visibility',
												'field'    => 'name',
												'terms'    => 'featured',
												'operator' => 'IN',
											);
										?>
										<?php $args = array( 'post_type' => 'product','posts_per_page' => 10,'ignore_sticky_posts' => 1, 'tax_query' => $tax_query); ?>
										<?php $getposts = new WP_query( $args);?>
										<?php global $wp_query; $wp_query->in_the_loop = true; ?>
										<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
										<?php global $product; ?>
											<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
													<div class="item-product">
														<div class="thumb">
															<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' =>'thumnail') ); ?></a>
															<?php if($product->is_on_sale()): ?>
																<?php $regular_price = $product->get_regular_price(); ?>
																<?php $sale_price = $product->get_sale_price();  ?>
																<span class="sale">Giảm <br><?php echo round((($regular_price-$sale_price)/$regular_price)*100,2)."%"; ?></span>
															<?php endif;?>
															<div class="action">
																<a href="?add-to-cart=<?php the_ID();?>" class="buy"><i class="fa fa-cart-plus"></i> Mua ngay</a>
																<a href="<?php the_permalink(); ?>" class="like"><i class="fa fa-heart"></i> Yêu thích</a>
																<div class="clear"></div>
															</div>
														</div>
														<div class="info-product">
															<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
															<div class="price">
																<?php echo $product->get_price_html(); ?>
															</div>
															<a href="<?php the_permalink(); ?>" class="view-more">Xem chi tiết</a>
														</div>
													</div>
											</div>
										<?php endwhile; wp_reset_postdata(); ?>
										</div>
									</div>
								</div>
								<a href="#"><img src="https://phongtrodn.com/wp-content/uploads/2020/02/huykira.png" alt=""></a>
								<br>
								<br>
								<div class="product-section">
									<h2 class="title-product">
										<?php $cat = get_term_by('id',33,'product_cat'); ?>
										<a href="<?php echo get_term_link($cat->slug, 'product_cat');?>" class="title"><?php echo $cat->name;?></a>
										<div class="bar-menu"><i class="fa fa-bars"></i></div>
										<div class="list-child">
											<ul>
											<?php
												$args = array(
													'type'      => 'product',
													'child_of'  => 0,
													'parent'    => $cat->term_id,
													'taxonomy'	=> 'product_cat',
													'hide_empty'=> 0,
													'number'	=> 5
												);
												$categories = get_categories( $args );
												foreach ( $categories as $category ) { ?>
													<li><a href="<?php echo get_term_link($category->slug, 'product_cat');?>"><?php echo $category->name; ?></a></li>
												<?php } ?>
											</ul>
										</div>
										<div class="clear"></div>
									</h2>
									<div class="content-product-box">
										<div class="row">
										<?php $args = array( 
											'post_type' => 'product',
											'posts_per_page' => 10,
											'ignore_sticky_posts' => 1,
											'product_cat'=> $cat->slug ); ?>
										<?php $getposts = new WP_query( $args);?>
										<?php global $wp_query; $wp_query->in_the_loop = true; ?>
										<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
										<?php global $product; ?>
											<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
													<div class="item-product">
														<div class="thumb">
															<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' =>'thumnail') ); ?></a>
															<?php if($product->is_on_sale()): ?>
																<?php $regular_price = $product->get_regular_price(); ?>
																<?php $sale_price = $product->get_sale_price();  ?>
																<span class="sale">Giảm <br><?php echo round((($regular_price-$sale_price)/$regular_price)*100,2)."%"; ?></span>
															<?php endif;?>
															
															<div class="action">
																<a href="?add-to-cart=<?php the_ID();?>" class="buy"><i class="fa fa-cart-plus"></i> Mua ngay</a>
																<a href="<?php the_permalink(); ?>" class="like"><i class="fa fa-heart"></i> Yêu thích</a>
																<div class="clear"></div>
															</div>
														</div>
														<div class="info-product">
															<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
															<div class="price">
																<?php echo $product->get_price_html(); ?>
															</div>
															<a href="<?php the_permalink(); ?>" class="view-more">Xem chi tiết</a>
														</div>
													</div>
											</div>
										<?php endwhile; wp_reset_postdata(); ?>
										</div>
									</div>
								</div>
								<div class="product-section">
									<h2 class="title-product">
										<?php $cat = get_term_by('id',36,'product_cat'); ?>
										<a href="<?php echo get_term_link($cat->slug, 'product_cat');?>" class="title"><?php echo $cat->name;?></a>
										<div class="bar-menu"><i class="fa fa-bars"></i></div>
										<div class="list-child">
											<ul>
											<?php
												$args = array(
													'type'      => 'product',
													'child_of'  => 0,
													'parent'    => $cat->term_id,
													'taxonomy'	=> 'product_cat',
													'hide_empty'=> 0,
													'number'	=> 5
												);
												$categories = get_categories( $args );
												foreach ( $categories as $category ) { ?>
													<li><a href="<?php echo get_term_link($category->slug, 'product_cat');?>"><?php echo $category->name; ?></a></li>
												<?php } ?>
											</ul>
										</div>
										<div class="clear"></div>
									</h2>
									<div class="content-product-box">
										<div class="row">
										<?php $args = array( 
											'post_type' => 'product',
											'posts_per_page' => 10,
											'ignore_sticky_posts' => 1,
											'product_cat'=> $cat->slug ); ?>
										<?php $getposts = new WP_query( $args);?>
										<?php global $wp_query; $wp_query->in_the_loop = true; ?>
										<?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
										<?php global $product; ?>
											<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
													<div class="item-product">
														<div class="thumb">
															<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' =>'thumnail') ); ?></a>
															<?php if($product->is_on_sale()): ?>
																<?php $regular_price = $product->get_regular_price(); ?>
																<?php $sale_price = $product->get_sale_price();  ?>
																<span class="sale">Giảm <br><?php echo round((($regular_price-$sale_price)/$regular_price)*100,2)."%"; ?></span>
															<?php endif;?>
															<div class="action">
																<a href="?add-to-cart=<?php the_ID();?>" class="buy"><i class="fa fa-cart-plus"></i> Mua ngay</a>
																<a href="<?php the_permalink(); ?>" class="like"><i class="fa fa-heart"></i> Yêu thích</a>
																<div class="clear"></div>
															</div>
														</div>
														<div class="info-product">
															<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
															<div class="price">
																<?php echo $product->get_price_html(); ?>
															</div>
															<a href="<?php the_permalink(); ?>" class="view-more">Xem chi tiết</a>
														</div>
													</div>
											</div>
										<?php endwhile; wp_reset_postdata(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php get_footer(); ?>