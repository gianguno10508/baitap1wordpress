<?php get_header(); ?>
<?php get_template_part('slider'); ?>
<div id="content">
    <div class="container">
        <div class="section1">
            <div class="section1-title">
                <h3 class="sub-title">
                    Just for you
                </h3>
                <h2 class="title">
                    Making & crafting
                </h2>
                <div class="categories">
                    <div class="container">
                        <!-- <div class="list-child">
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
                                    print_r($categories);
                                    foreach ( $categories as $category ) { ?>
                                    <?php 
                                        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                                        $image = wp_get_attachment_url( $thumbnail_id );
                                    ?>
                                        <img src="<?php $image; ?>" alt="">
                                        <li><a href="<?php echo get_term_link($category->slug, 'product_cat');?>"><?php echo $category->name; ?></a></li>
                                    <?php } ?>
                            </ul>
                        </div> -->
					    <div class="list-category">
                            <?php 
                                $taxonomyName = "product_cat";
                                //This gets top layer terms only.  This is done by setting parent to 0.  
                                $parent_terms = get_terms($taxonomyName, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => false));?>
                                <div class="slider multiple-items" role="toolbar">
                                        <?php foreach ($parent_terms as $pterm) {                                                             
                                            $thumbnail_id = get_woocommerce_term_meta($pterm->term_id, 'thumbnail_id', true);
                                            // get the image URL for parent category
                                            $image = wp_get_attachment_url($thumbnail_id);
                                            // print the IMG HTML for parent category
                                            $link = "<img src='{$image}' alt='' width='400' height='400' />";
                                            ?>
                                            
                                            <div class="col">
                                                <div class="img-col-cate">
                                                    <?php echo '<a href="' . get_term_link($pterm->name, $taxonomyName) . '">' . $link . '</a>'; ?>
                                                </div>
                                                <div class="name-col-cate">
                                                    <?php echo '<a href="' . get_term_link($pterm->name, $taxonomyName) . '">' . $pterm->name . '</a>'; ?>
                                                    <?php echo "<p>_______($pterm->count)</p>" ?>
                                                </div>
                                            </div>
                                        <?php
                                        }?>                                    
                                </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section2">
            <div class="section2-title">
                <h3 class="sub-title">
                    Shop Now
                </h3>
                <h2 class="title">
                    Shop our best sellers
                </h2>
                <div class="list-product-seller">
                    <div class="content-product-box">
                        <div class="row">
                            <?php $args = array( 
                                'post_type' => 'product',
                                'posts_per_page' => 10, 
                                'meta_query'     => array(
                                'relation' => 'OR',
                                    array(
                                        'key'           => '_sale_price',
                                        'value'         => 0,
                                        'compare'       => '>',
                                        'type'          => 'numeric'
                                    )
                                )
                            ); ?>
                            <?php $getposts = new WP_query( $args);?>
                            <?php global $wp_query; $wp_query->in_the_loop = true; ?>
                            <?php while ($getposts->have_posts()) : $getposts->the_post(); ?>
                            <?php global $product; ?>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="item-product">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php echo get_the_post_thumbnail(get_the_ID(), 'thumnail', array( 'class' =>'thumnail') ); ?>
                                        </a>
                                        <?php $gallery_img_product = $product->gallery_image_ids; ?>
                                        <div class="img-hover">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php $image_link = wp_get_attachment_url( $gallery_img_product[2] ); ?>
                                                <img src="<?php echo $image_link; ?>" alt="">
                                            </a>
                                        </div>
                                        <?php if($product->is_on_sale()): ?>
											<?php $regular_price = $product->get_regular_price(); ?>
											<?php $sale_price = $product->get_sale_price();  ?>
                                            <span class="sale sale-p">Sale</span>
											<span class="sale">Giảm <br><?php echo round((($regular_price-$sale_price)/$regular_price)*100,2)."%"; ?></span>
											<?php endif;?>
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    
                                        <div class="price-product"><?php echo $product->get_price_html(); ?></div>
                                        <div class="action">
											<a href="?add-to-cart=<?php the_ID();?>" class="buy"><i class="fa fa-cart-plus"></i> Mua ngay</a>
											<a href="<?php the_permalink(); ?>" class="like"><i class="fa fa-heart"></i> Yêu thích</a>
											<div class="clear"></div>
										</div>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_postdata();?>
						</div>
				    </div>                    
                </div>
            </div>
        </div>
        <div class="section3">
            <div class="section3-title">
                <h3 class="sub-title">
                    Featured Items
                </h3>
                <h2 class="title">
                    Shop our featured item
                </h2>
                <div class="list-product-featured">
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
                                        <?php $gallery_img_product = $product->gallery_image_ids; ?>
                                        <div class="img-hover">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php $image_link = wp_get_attachment_url( $gallery_img_product[2] ); ?>
                                                <img src="<?php echo $image_link; ?>" alt="">
                                            </a>
                                        </div>
										<?php if($product->is_on_sale()): ?>
											<?php $regular_price = $product->get_regular_price(); ?>
											<?php $sale_price = $product->get_sale_price();  ?>
                                            <span class="sale sale-p">Sale</span>
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
										<div class="price-product">
											<?php echo $product->get_price_html(); ?>
										</div>
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
<?php get_footer();?>
