<?php

$wp_blocks_source = array();

// archives
$wp_blocks_source[] = array(
	'blockName'    => 'core/archives',
	'attrs'        => array(
		'showPostCounts'    => true,
		'displayAsDropdown' => false,
	),
	'className'    => 'widget_archive',
	'blockHeading' => esc_html__( 'Block Archives List', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/archives',
	'attrs'        => array(
		'showPostCounts'    => true,
		'displayAsDropdown' => true,
	),
	'className'    => 'widget_archive',
	'blockHeading' => esc_html__( 'Block Archives Dropdown', 'bwm' ),
);

// calendar
$wp_blocks_source[] = array(
	'blockName'    => 'core/calendar',
	'attrs'        => array(),
	'className'    => 'widget_calendar',
	'blockHeading' => esc_html__( 'Block Calendar', 'bwm' ),
);

// categories
$wp_blocks_source[] = array(
	'blockName'    => 'core/categories',
	'attrs'        => array(
		'displayAsDropdown' => false,
		'showHierarchy'     => true,
		'showPostCounts'    => true,
	),
	'className'    => 'widget_categories',
	'blockHeading' => esc_html__( 'Block Categories List', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/categories',
	'attrs'        => array(
		'displayAsDropdown' => true,
		'showHierarchy'     => true,
		'showPostCounts'    => true,
	),
	'className'    => 'widget_categories',
	'blockHeading' => esc_html__( 'Block Categories Dropdown', 'bwm' ),
);

// latest comments
$wp_blocks_source[] = array(
	'blockName'    => 'core/latest-comments',
	'attrs'        => array(
		'commentsToShow' => $rows,
		'displayAvatar'  => true,
		'displayDate'    => true,
		'displayExcerpt' => true,
	),
	'className'    => 'widget_recent_comments',
	'blockHeading' => esc_html__( 'Block Latest Comments W/ Avatar', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/latest-comments',
	'attrs'        => array(
		'commentsToShow' => $rows,
		'displayAvatar'  => false,
		'displayDate'    => true,
		'displayExcerpt' => true,
	),
	'className'    => 'widget_recent_comments',
	'blockHeading' => esc_html__( 'Block Latest Comments W/O Avatar', 'bwm' ),
);

// latest posts
$wp_blocks_source[] = array(
	'blockName'    => 'core/latest-posts',
	'attrs'        => array(
		'displayPostContent'     => true,
		'excerptLength'          => 35,
		'displayAuthor'          => true,
		'displayPostDate'        => true,
		'postLayout'             => '',
		'columns'                => '',
		'displayFeaturedImage'   => true,
		'addLinkToFeaturedImage' => true,
		'postsToShow'            => $rows,
	),
	'className'    => 'widget_recent_entries',
	'blockHeading' => esc_html__( 'Block Latest Posts W/ Image', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/latest-posts',
	'attrs'        => array(
		'displayPostContent'     => true,
		'excerptLength'          => 35,
		'displayAuthor'          => true,
		'displayPostDate'        => true,
		'postLayout'             => '',
		'columns'                => '',
		'displayFeaturedImage'   => false,
		'addLinkToFeaturedImage' => true,
		'postsToShow'            => $rows,
	),
	'className'    => 'widget_recent_entries',
	'blockHeading' => esc_html__( 'Block Latest Posts W/O Image', 'bwm' ),
);

// login/logout
$wp_blocks_source[] = array(
	'blockName'    => 'core/loginout',
	'attrs'        => array(
		'displayLoginAsForm' => false,
		'redirectToCurrent'  => true,
	),
	'className'    => '',
	'blockHeading' => esc_html__( 'Block Login Link', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/loginout',
	'attrs'        => array(
		'displayLoginAsForm' => true,
		'redirectToCurrent'  => true,
	),
	'className'    => '',
	'blockHeading' => esc_html__( 'Block Login Form', 'bwm' ),
);

// page list
$wp_blocks_source[] =
	array(
		'blockName'    => 'core/page-list',
		'attrs'        => array(),
		'className'    => '',
		'blockHeading' => esc_html__( 'Block Page List', 'bwm' ),
	);

// rss
$wp_blocks_source[] = array(
	'blockName'    => 'core/rss',
	'attrs'        =>
		array(
			'feedURL'        => 'http://themeshaper.com/feed',
			'itemsToShow'    => $rows,
			'displayExcerpt' => true,
			'displayAuthor'  => true,
			'displayDate'    => true,
			'excerptLength'  => 35,
		),
	'className'    => 'widget_rss',
	'blockHeading' => esc_html__( 'Block RSS', 'bwm' ),
);

// social icons
$wp_blocks_source[] = array(
	'blockName'    => 'core/social-links',
	'attrs'        => array(),
	'innerBlocks'  => array(
		array(
			'blockName' => 'core/social-link',
			'attrs'     => array(
				'url'     => '#',
				'service' => 'fivehundredpx',
				'label'   => esc_html__( 'Lorem ipsum dolor sit amet', 'bwm' ),
			),
		),
		array(
			'blockName' => 'core/social-link',
			'attrs'     => array(
				'url'     => '#',
				'service' => 'wordpress',
				'label'   => esc_html__( 'Lorem ipsum dolor sit amet', 'bwm' ),
			),
		),
		array(
			'blockName' => 'core/social-link',
			'attrs'     => array(
				'url'     => '#',
				'service' => 'amazon',
				'label'   => esc_html__( 'Lorem ipsum dolor sit amet', 'bwm' ),
			),
		),
		array(
			'blockName' => 'core/social-link',
			'attrs'     => array(
				'url'     => '#',
				'service' => 'bandcamp',
				'label'   => esc_html__( 'Lorem ipsum dolor sit amet', 'bwm' ),
			),
		),
	),
	'innerHTML'    => '<ul class="wp-block-social-links"></ul>',
	'innerContent' => array(
		'<ul class="wp-block-social-links">',
		null,
		null,
		null,
		null,
		'</ul>',
	),
	'className'    => 'widget_block',
	'blockHeading' => esc_html__( 'Block Social Icons', 'bwm' ),
);

// search
$wp_blocks_source[] = array(
	'blockName'    => 'core/search',
	'attrs'        => array(
		'label'          => esc_html__( 'Search', 'bwm' ),
		'buttonText'     => esc_html__( 'Search', 'bwm' ),
		'showLabel'      => true,
		'placeholder'    => esc_html__( 'Placeholder', 'bwm' ),
		'buttonPosition' => 'button-outside',
		'buttonUseIcon'  => false,
	),
	'className'    => 'widget_search',
	'blockHeading' => esc_html__( 'Block Search Text Button Outside', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/search',
	'attrs'        => array(
		'label'          => esc_html__( 'Search', 'bwm' ),
		'buttonText'     => esc_html__( 'Search', 'bwm' ),
		'showLabel'      => true,
		'placeholder'    => esc_html__( 'Placeholder', 'bwm' ),
		'buttonPosition' => 'button-inside',
		'buttonUseIcon'  => false,
	),
	'className'    => 'widget_search',
	'blockHeading' => esc_html__( 'Block Search Text Button Inside', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/search',
	'attrs'        => array(
		'label'          => esc_html__( 'Search', 'bwm' ),
		'buttonText'     => esc_html__( 'Search', 'bwm' ),
		'showLabel'      => true,
		'placeholder'    => esc_html__( 'Placeholder', 'bwm' ),
		'buttonPosition' => 'no-button',
		'buttonUseIcon'  => false,
	),
	'className'    => 'widget_search',
	'blockHeading' => esc_html__( 'Block No Button', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/search',
	'attrs'        => array(
		'label'          => esc_html__( 'Search', 'bwm' ),
		'buttonText'     => esc_html__( 'Search', 'bwm' ),
		'showLabel'      => true,
		'placeholder'    => esc_html__( 'Placeholder', 'bwm' ),
		'buttonPosition' => 'button-outside',
		'buttonUseIcon'  => true,
	),
	'className'    => 'widget_search',
	'blockHeading' => esc_html__( 'Block Search Icon Button Outside', 'bwm' ),
);
$wp_blocks_source[] = array(
	'blockName'    => 'core/search',
	'attrs'        => array(
		'label'          => esc_html__( 'Search', 'bwm' ),
		'buttonText'     => esc_html__( 'Search', 'bwm' ),
		'showLabel'      => true,
		'placeholder'    => esc_html__( 'Placeholder', 'bwm' ),
		'buttonPosition' => 'button-inside',
		'buttonUseIcon'  => true,
	),
	'className'    => 'widget_search',
	'blockHeading' => esc_html__( 'Block Search Icon Button Inside', 'bwm' ),
);

// tag cloud
$wp_blocks_source[] = array(
	'blockName'    => 'core/tag-cloud',
	'attrs'        => array(
		'showTagCounts' => true,
	),
	'className'    => 'widget_tag_cloud',
	'blockHeading' => esc_html__( 'Block Tag Cloud', 'bwm' ),
);

$wp_blocks = $this->group_blocks( $wp_blocks_source, $group );
