<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<!-- <li <?php wc_product_class( '', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li> -->
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
													<div class="item-product">
														<div class="thumb">
															<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' =>'thumnail') ); ?></a>
															<?php if($product->is_on_sale()): ?>
																<?php $regular_price = $product->get_regular_price(); ?>
																<?php $sale_price = $product->get_sale_price();  ?>
																<span class="sale">Gi???m <br><?php echo round((($regular_price-$sale_price)/$regular_price)*100,2)."%"; ?></span>
															<?php endif;?>
															<div class="action">
																<a href="?add-to-cart=<?php the_ID();?>" class="buy"><i class="fa fa-cart-plus"></i> Mua ngay</a>
																<a href="<?php the_permalink(); ?>" class="like"><i class="fa fa-heart"></i> Y??u th??ch</a>
																<div class="clear"></div>
															</div>
														</div>
														<div class="info-product">
															<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
															<div class="price">
																<?php echo $product->get_price_html(); ?>
															</div>
															<a href="<?php the_permalink(); ?>" class="view-more">Xem chi ti???t</a>
														</div>
													</div>
											</div>
