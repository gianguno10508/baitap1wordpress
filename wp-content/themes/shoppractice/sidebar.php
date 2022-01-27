									<div class="category-box">
										<h3>
											Danh mục sản phẩm
										</h3>
										<div class="content-cat">
											<ul>
												<?php
												$args = array(
													'type'      => 'product',
													'child_of'  => 0,
													'taxonomy'	=> 'product_cat',
													'hide_empty'=> 0
												);
												$categories = get_categories( $args );
												foreach ( $categories as $category ) { ?>
													<li><i class="fa fa-angle-right"></i> <a href="<?php echo get_term_link($category->slug, 'product_cat');?>"><?php echo $category->name; ?></a></li>
												<?php } ?>

											</ul>
										</div>
									</div>

