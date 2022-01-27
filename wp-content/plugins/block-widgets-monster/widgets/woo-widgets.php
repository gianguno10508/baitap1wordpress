<?php

$woo_widgets = array();

// cart
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Cart',
	'attrs'      => array(
		'title' => esc_html__( 'Legacy Cart', 'bwm' ),
	),
	'className'  => 'woocommerce widget_shopping_cart',
);

// product search
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Product_Search',
	'attrs'      => array(
		'title' => esc_html__( 'Legacy Search Product', 'bwm' ),
	),
	'className'  => 'woocommerce widget_product_search',
);

// layered nav filter
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Layered_Nav_Filters',
	'attrs'      => array(
		'title' => esc_html__( 'Legacy Layered Nav Filter', 'bwm' ),
	),
	'className'  => 'woocommerce widget_layered_nav_filters',
);

// layered nav
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Layered_Nav',
	'attrs'      => array(
		'title'        => esc_html__( 'Legacy Layered Nav List', 'bwm' ),
		'attribute'    => 'color',
		'display_type' => 'list',
		'query_type'   => 'or',
	),
	'className'  => 'woocommerce widget_layered_nav woocommerce-widget-layered-nav',
);
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Layered_Nav',
	'attrs'      => array(
		'title'        => esc_html__( 'Legacy Layered Nav Dropdown', 'bwm' ),
		'attribute'    => 'color',
		'display_type' => 'dropdown',
		'query_type'   => 'or',
	),
	'className'  => 'woocommerce widget_layered_nav woocommerce-widget-layered-nav',
);

// price filter
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Price_Filter',
	'attrs'      => array(
		'title' => esc_html__( 'Legacy Price Filter', 'bwm' ),
	),
	'className'  => 'woocommerce widget_price_filter',
);

// product categories
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Product_Categories',
	'attrs'      => array(
		'title'              => esc_html__( 'Legacy Product Categories Dropdown', 'bwm' ),
		'orderby'            => 'name',
		'dropdown'           => 1,
		'count'              => 1,
		'hierarchical'       => 1,
		'show_children_only' => 0,
	),
	'className'  => 'woocommerce widget_product_categories',
);
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Product_Categories',
	'attrs'      => array(
		'title'              => esc_html__( 'Legacy Product Categories List', 'bwm' ),
		'orderby'            => 'name',
		'dropdown'           => 0,
		'count'              => 1,
		'hierarchical'       => 1,
		'show_children_only' => 0,
	),
	'className'  => 'woocommerce widget_product_categories',
);

// products tag cloud
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Product_Tag_Cloud',
	'attrs'      => array(
		'title' => esc_html__( 'Legacy Product Tag Cloud', 'bwm' ),
	),
	'className'  => 'woocommerce widget_product_tag_cloud',
);

// all products
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Products',
	'attrs'      => array(
		'title'       => esc_html__( 'Legacy All Products', 'bwm' ),
		'number'      => $rows,
		'show'        => '',
		'orderby'     => 'date',
		'order'       => 'desc',
		'hide_free'   => 0,
		'show_hidden' => 0,
	),
	'className'  => 'woocommerce widget_products',
);
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Products',
	'attrs'      => array(
		'title'       => esc_html__( 'Legacy Featured Products', 'bwm' ),
		'number'      => $rows,
		'show'        => 'featured',
		'orderby'     => 'date',
		'order'       => 'desc',
		'hide_free'   => 0,
		'show_hidden' => 0,
	),
	'className'  => 'woocommerce widget_products',
);
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Products',
	'attrs'      => array(
		'title'       => esc_html__( 'Legacy Products On-Sale', 'bwm' ),
		'number'      => $rows,
		'show'        => 'onsale',
		'orderby'     => 'date',
		'order'       => 'desc',
		'hide_free'   => 0,
		'show_hidden' => 0,
	),
	'className'  => 'woocommerce widget_products',
);

// recent reviews
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Recent_Reviews',
	'attrs'      => array(
		'title'  => esc_html__( 'Legacy Recent Reviews', 'bwm' ),
		'number' => $rows,
	),
	'className'  => 'woocommerce widget_recent_reviews',
);

// recently viewed products
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Recently_Viewed',
	'attrs'      => array(
		'title'  => esc_html__( 'Legacy Recently Viewed Products', 'bwm' ),
		'number' => $rows,
	),
	'className'  => 'woocommerce widget_recently_viewed_products',
);

// top rated products
$woo_widgets[] = array(
	'widgetName' => 'WC_Widget_Top_Rated_Products',
	'attrs'      => array(
		'title'  => esc_html__( 'Legacy Top Rated Products', 'bwm' ),
		'number' => $rows,
	),
	'className'  => 'woocommerce widget_top_rated_products',
);
