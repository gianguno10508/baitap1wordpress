<?php

$wp_widgets = array();

// archives
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Archives',
	'attrs'      => array(
		'title'    => esc_html__( 'Legacy Archives List', 'bwm' ),
		'count'    => 1,
		'dropdown' => 0,
	),
	'className'  => 'widget_archive',
);
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Archives',
	'attrs'      => array(
		'title'    => esc_html__( 'Legacy Archives Dropdown', 'bwm' ),
		'count'    => 1,
		'dropdown' => 1,
	),
	'className'  => 'widget_archive',
);

// calendar
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Calendar',
	'attrs'      => array(
		'title' => esc_html__( 'Legacy Calendar', 'bwm' ),
	),
	'className'  => 'widget_calendar',
);

// categories
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Categories',
	'attrs'      => array(
		'title'        => esc_html__( 'Legacy Categories List', 'bwm' ),
		'count'        => 1,
		'hierarchical' => 1,
		'dropdown'     => 0,
	),
	'className'  => 'widget_categories',
);
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Categories',
	'attrs'      => array(
		'title'        => esc_html__( 'Legacy Categories Dropdown', 'bwm' ),
		'count'        => 1,
		'hierarchical' => 1,
		'dropdown'     => 1,
	),
	'className'  => 'widget_categories',
);

// pages
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Pages',
	'attrs'      => array(
		'title'   => esc_html__( 'Legacy Pages', 'bwm' ),
		'sortby'  => 'menu_order',
		'exclude' => '',
	),
	'className'  => 'widget_pages',
);

// meta
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Meta',
	'attrs'      => array(
		'title' => esc_html__( 'Legacy Meta', 'bwm' ),
	),
	'className'  => 'widget_meta',
);

// nav menu
if ( $this->wp_menu ) {
	$wp_widgets[] = array(
		'widgetName' => 'WP_Nav_Menu_Widget',
		'attrs'      => array(
			'title'    => esc_html__( 'Legacy Nav Menu', 'bwm' ),
			'nav_menu' => $this->wp_menu,
		),
		'className'  => 'widget_nav_menu',
	);
}

// recent comments
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Recent_Comments',
	'attrs'      => array(
		'title'  => esc_html__( 'Legacy Recent Comments', 'bwm' ),
		'number' => $rows,
	),
	'className'  => 'widget_recent_comments',
);

// recent posts
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Recent_Posts',
	'attrs'      => array(
		'title'  => esc_html__( 'Legacy Recent Posts', 'bwm' ),
		'number' => $rows,
	),
	'className'  => 'widget_recent_entries',
);

// rss
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_RSS',
	'attrs'      => array(
		'title'        => esc_html__( 'Legacy RSS', 'bwm' ),
		'url'          => 'http://themeshaper.com/feed',
		'items'        => $rows,
		'show_author'  => true,
		'show_date'    => true,
		'show_summary' => true,
	),
	'className'  => 'widget_rss',
);

// search
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Search',
	'attrs'      => array(
		'title' => __( 'Legacy Search', 'bwm' ),
	),
	'className'  => 'widget_search',
);

// text
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Text',
	'attrs'      => array(
		'title'  => esc_html__( 'Legacy Text', 'bwm' ),
		'text'   => $this->wp_html,
		'filter' => true,
	),
	'className'  => 'widget_text',
);

// tag cloud
$wp_widgets[] = array(
	'widgetName' => 'WP_Widget_Tag_Cloud',
	'attrs'      => array(
		'title'    => esc_html__( 'Legacy Tag Cloud', 'bwm' ),
		'taxonomy' => 'post_tag',
	),
	'className'  => 'widget_tag_cloud',
);
