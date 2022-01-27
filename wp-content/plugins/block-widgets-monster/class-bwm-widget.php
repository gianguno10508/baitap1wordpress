<?php

if ( ! function_exists( 'bwm_register_widget' ) ) {
	/**
	 * register widget
	 *
	 * hooked on 'widgets_init' action
	 *
	 * @since 1.0.0
	 */
	function bwm_register_widget() {
		register_widget( 'BWM_Widget' );
	}

	add_action( 'widgets_init', 'bwm_register_widget' );
}

if ( ! class_exists( 'BWM_Widget' ) ) {
	/**
	 * class BMW_Widget
	 */
	class BWM_Widget extends WP_Widget {
		// wp vars
		public $wp_html;
		public $wp_menu;

		// woo vars
		public $is_woo_installed;
		public $woo_product_id;
		public $woo_product_category_id;
		public $woo_product_tag_id;
		public $woo_taxonomy;
		public $woo_term_id;

		/**
		 * BWM_Widget constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			parent::__construct(
				'Block_Widgets_Monster',
				esc_html__( 'Block Widgets Monster', 'bwm' ),
				array(
					'classname'   => 'bwm',
					'description' => esc_html__( 'Test multiple block widgets at the same time.', 'bwm' ),
				)
			);

			$this->wp_html = $this->get_wp_html();
			$this->wp_menu = $this->get_wp_menu();

			$this->is_woo_installed = class_exists( 'WooCommerce' );
			// if woo is installed
			if ( $this->is_woo_installed ) {
				$this->get_woo_product_id();
				add_action( 'init', array( $this, 'get_woo_product_category_id' ) );
				add_action( 'init', array( $this, 'get_woo_product_tag_id' ) );
				$this->get_woo_taxonomy_attrs();
			}
		}

		/**
		 * widget backend output
		 *
		 * @param array $instance - widget instance
		 *
		 * @since 1.0.0
		 */
		public function form( $instance ) {
			$source = $instance['source'] ?? 'all';
			$type   = $instance['type'] ?? 'all';
			$cols   = $instance['cols'] ?? 1;
			$rows   = $instance['rows'] ?? 3;
			$group  = $instance['group'] ?? '';
			?>
			<div>
				<p>
					<label for="<?php echo $this->get_field_id( 'source' ); ?>"><?php echo esc_html__( 'Widget source:', 'bwm' ); ?></label>
					<select id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>">
						<?php if ( $this->is_woo_installed ) : ?>
							<option value="all" <?php selected( $source, 'all' ); ?>><?php echo esc_html__( 'WordPress & WooCommerce', 'bwm' ); ?></option>
						<?php endif; ?>
						<option value="wp" <?php selected( $source, 'wp' ); ?>><?php echo esc_html__( 'WordPress', 'bwm' ); ?></option>
						<?php if ( $this->is_woo_installed ) : ?>
							<option value="woo" <?php selected( $source, 'woo' ); ?>><?php echo esc_html__( 'WooCommerce', 'bwm' ); ?></option>
						<?php endif; ?>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php echo esc_html__( 'Widget type:', 'bwm' ); ?></label>
					<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
						<option value="all" <?php selected( $type, 'all' ); ?>><?php echo esc_html__( 'Block & Legacy', 'bwm' ); ?></option>
						<option value="block" <?php selected( $type, 'block' ); ?>><?php echo esc_html__( 'Block', 'bwm' ); ?></option>
						<option value="legacy" <?php selected( $type, 'legacy' ); ?>><?php echo esc_html__( 'Legacy', 'bwm' ); ?></option>
					</select>
				</p>
				<?php if ( $this->is_woo_installed ) : ?>
					<p>
						<label for="<?php echo $this->get_field_id( 'cols' ); ?>"><?php echo esc_html__( 'Number of colummns:', 'bwm' ); ?></label>
						<input id="<?php echo $this->get_field_id( 'cols' ); ?>" name="<?php echo $this->get_field_name( 'cols' ); ?>" type="number" min="1" max="5" value="<?php echo esc_attr( $cols ); ?>">
						<span class="description"><?php echo esc_html__( 'This option is applied to some WooCommerce block widgets only', 'bwm' ); ?></span>
					</p>
				<?php endif; ?>
				<p>
					<label for="<?php echo $this->get_field_id( 'rows' ); ?>"><?php echo esc_html__( 'Number of rows:', 'bwm' ); ?></label>
					<input id="<?php echo $this->get_field_id( 'rows' ); ?>" name="<?php echo $this->get_field_name( 'rows' ); ?>" type="number" min="1" max="5" value="<?php echo esc_attr( $rows ); ?>">
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'group' ); ?>"><?php echo esc_html__( 'Show title before block widgets:', 'bwm' ); ?></label>
					<input <?php checked( $group, 'yes' ); ?> id="<?php echo $this->get_field_id( 'group' ); ?>" name="<?php echo $this->get_field_name( 'group' ); ?>" type="checkbox" value="yes">
					<br>
					<span class="description"><?php echo esc_html__( 'Enabling this option will output block heading with h2 tag and particular block widget as a grouped element, as seen in default sidebar content', 'bwm' ); ?></span>
				</p>
			</div>
			<?php
		}

		/**
		 * widget frontend output
		 *
		 * @param array $args     - dynamic sidebar args
		 * @param array $instance - widget instance
		 *
		 * @since 1.0.0
		 */
		public function widget( $args, $instance ) {
			$source = $instance['source'];
			$type   = $instance['type'];
			$cols   = $instance['cols'] ?? '';
			$rows   = $instance['rows'];
			$group  = ! empty( $instance['group'] ) ?? $instance['group'];

			if ( 'all' === $type || 'block' === $type ) {
				$blocks = $this->get_blocks( $source, $cols, $rows, $group );

				foreach ( $blocks as $block ) {
					$classes           = array();
					$classes[]         = 'widget';
					$classes[]         = 'widget_block';
					$classes[]         = $block['className'];
					$args['widget_id'] = 'bwm-block-' . wp_rand( 0, 100000 ); // generate new unique id to prevent widget caching
					$block_object      = new WP_Block( $block );

					echo $this->get_before_widget( $args['before_widget'], $classes );
					echo $block_object->render();
					echo $args['after_widget'];
				}
			}

			if ( 'all' === $type || 'legacy' === $type ) {
				$widgets = $this->get_widgets( $source, $rows );

				foreach ( $widgets as $widget ) {
					$classes               = array();
					$classes[]             = 'widget';
					$classes[]             = $widget['className'];
					$args['before_widget'] = $this->get_before_widget( $args['before_widget'], $classes );
					$args['widget_id']     = 'bwm-widget-' . wp_rand( 0, 100000 ); // generate new unique id to prevent widget caching

					the_widget( $widget['widgetName'], $widget['attrs'], $args );
				}
			}
		}

		/**
		 * widget update method
		 *
		 * @param array $new_instance - new widget instance
		 * @param array $old_instance - old widget instance
		 *
		 * @return array
		 *
		 * @since 1.0.0
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();

			if ( ! empty( $new_instance['source'] ) ) {
				$instance['source'] = $new_instance['source'];
			}
			if ( ! empty( $new_instance['type'] ) ) {
				$instance['type'] = $new_instance['type'];
			}
			if ( ! empty( $new_instance['cols'] ) ) {
				$instance['cols'] = (int) $new_instance['cols'];
			}
			if ( ! empty( $new_instance['rows'] ) ) {
				$instance['rows'] = (int) $new_instance['rows'];
			}
			if ( ! empty( $new_instance['group'] ) ) {
				$instance['group'] = $new_instance['group'];
			}

			return $instance;
		}

		/**
		 * get list of available blocks
		 *
		 * @param string $source - wp, woo or both
		 * @param int    $cols   - number of columns
		 * @param int    $rows   - number of columns
		 * @param bool   $group  - add title before block widget to output as group
		 *
		 * @return array
		 *
		 * @since 1.0.0
		 */
		public function get_blocks( $source, $cols, $rows, $group ) {
			$blocks = array();

			include BWM_ABS_PATH . '/blocks/wp-blocks.php';

			$woo_blocks = array();
			if ( $this->is_woo_installed ) {
				include BWM_ABS_PATH . '/blocks/woo-blocks.php';
			}

			if ( 'all' === $source ) {
				$blocks = array_merge( $wp_blocks, $woo_blocks );
			} elseif ( 'wp' === $source ) {
				$blocks = $wp_blocks;
			} elseif ( 'woo' === $source ) {
				$blocks = $woo_blocks;
			}

			return apply_filters( 'bmw_filter_blocks', $blocks );
		}

		/**
		 * get list of available widgets
		 *
		 * @param string $source - wp, woo or both
		 * @param int    $rows   - number of rows
		 *
		 * @return array
		 *
		 * @since 1.0.0
		 */
		public function get_widgets( $source, $rows ) {
			$widgets = array();

			include BWM_ABS_PATH . '/widgets/wp-widgets.php';

			$woo_widgets = array();
			if ( $this->is_woo_installed ) {
				include BWM_ABS_PATH . '/widgets/woo-widgets.php';
			}

			if ( 'all' === $source ) {
				$widgets = array_merge( $wp_widgets, $woo_widgets );
			} elseif ( 'wp' === $source ) {
				$widgets = $wp_widgets;
			} elseif ( 'woo' === $source ) {
				$widgets = $woo_widgets;
			}

			return apply_filters( 'bwm_filter_widgets', $widgets );
		}

		/**
		 * replace before widget param with proper html class names and id
		 *
		 * @param string $before_widget - before widget param generated for dynamic sidebar
		 * @param array  $classes       - list of html class names
		 *
		 * @return string
		 *
		 * @since 1.0.0
		 */
		public function get_before_widget( $before_widget, $classes ) {
			// replace class
			$class     = implode( ' ', $classes );
			$has_class = false;

			$class_needle = 'class="';
			$class_start  = strpos( $before_widget, $class_needle, 0 );

			if ( $class_start ) {
				$class_end = strpos( $before_widget, '"', $class_start + strlen( $class_needle ) );
			}
			if ( $class_start && $class_end ) {
				$before_widget = substr_replace( $before_widget, $class, ( $class_start + strlen( $class_needle ) ), ( $class_end - $class_start - strlen( $class_needle ) ) );
				$has_class     = true;
			}

			// inject class
			if ( false === $has_class ) {
				$class_string       = ' class="' . $class . '"';
				$closing_tag_needle = '>';
				$closing_tag_start  = strpos( $before_widget, $closing_tag_needle, 0 );

				if ( $closing_tag_start ) {
					$before_widget = substr_replace( $before_widget, $class_string . $closing_tag_needle, $closing_tag_start, strlen( $closing_tag_needle ) );
				}
			}

			// replace id
			$id     = 'bmw-' . rand( 0, 10000 );
			$has_id = false;

			$id_needle = 'id="';
			$id_start  = strpos( $before_widget, $id_needle, 0 );

			if ( $id_start ) {
				$id_end = strpos( $before_widget, '"', $id_start + strlen( $id_needle ) );
			}
			if ( $id_start && $id_end ) {
				$before_widget = substr_replace( $before_widget, $id, ( $id_start + strlen( $id_needle ) ), ( $id_end - $id_start - strlen( $id_needle ) ) );
				$has_id        = true;
			}

			// inject id
			if ( false === $has_id ) {
				$id_string          = ' id="' . $id . '"';
				$closing_tag_needle = '>';
				$closing_tag_start  = strpos( $before_widget, $closing_tag_needle, 0 );

				if ( $closing_tag_start ) {
					$before_widget = substr_replace( $before_widget, $id_string . $closing_tag_needle, $closing_tag_start, strlen( $closing_tag_needle ) );
				}
			}

			return $before_widget;
		}

		/**
		 * generate html for text widget
		 *
		 * @return string
		 *
		 * @since 1.0.0
		 */
		public function get_wp_html() {
			$html = array();

			$html[] = '<strong>' . esc_html__( 'Large image: Hand Coded', 'bwm' ) . '</strong>';
			$html[] = '<img src="' . esc_url( BWM_URL_PATH . '/assets/images/bikes.jpg' ) . '" alt="">';
			$html[] = '<strong>' . esc_html__( 'Large image: linked in a caption', 'bwm' ) . '</strong>';
			$html[] = '<div class="wp-caption alignnone"><a href="#"><img src="' . esc_url( BWM_URL_PATH . '/assets/images/bikes.jpg' ) . '" class="size-large" height="720" width="960" alt=""></a><p class="wp-caption-text">' . __( 'This image is 960 by 720 pixels.', 'bwm' ) . ' ' . convert_smilies( ':)' ) . '</p></div>';
			$html[] = '<strong>' . esc_html__( 'Meat!', 'bwm' ) . '</strong>';
			$html[] = esc_html__( 'Hamburger fatback andouille, ball tip bacon t-bone turkey tenderloin. Ball tip shank pig, t-bone turducken prosciutto ground round rump bacon pork chop short loin turkey. Pancetta ball tip salami, hamburger t-bone capicola turkey ham hock pork belly tri-tip. Biltong bresaola tail, shoulder sausage turkey cow pork chop fatback. Turkey pork pig bacon short loin meatloaf, chicken ham hock flank andouille tenderloin shank rump filet mignon. Shoulder frankfurter shankle pancetta. Jowl andouille short ribs swine venison, pork loin pork chop meatball jerky filet mignon shoulder tenderloin chicken pork.', 'bwm' );
			$html[] = '<strong>' . esc_html__( 'Smile!', 'bwm' ) . '</strong>';
			$html[] = convert_smilies( ';)' ) . ' ' . convert_smilies( ':)' ) . ' ' . convert_smilies( ':-D' );
			$html[] = '<strong>' . esc_html__( 'Select Element with long value', 'bwm' ) . '</strong>';
			$html[] = '<form method="get" action="/">';
			$html[] = '<select name="bwm-just-testing">';
			$html[] = '<option value="0">' . esc_html__( 'First', 'bwm' ) . '</option>';
			$html[] = '<option value="1">' . esc_html__( 'Second', 'bwm' ) . '</option>';
			$html[] = '<option value="2">' . esc_html__( 'Third', 'bwm' ) . ' OMG! How can one option contain soooo many words? This really is a lot of words.</option>';
			$html[] = '</select>';
			$html[] = '</form>';

			$html = implode( "\n", $html );

			return $html;
		}

		/**
		 * get longest nav menu
		 *
		 * @return false|WP_Term|null
		 *
		 * @since 1.0.0
		 */
		public function get_wp_menu() {
			$menus = wp_get_nav_menus();

			if ( is_wp_error( $menus ) || empty( $menus ) ) {
				return false;
			}

			$counts = wp_list_pluck( $menus, 'count' );
			$menus  = array_combine( $counts, $menus );
			ksort( $menus );
			$menus = array_reverse( $menus );
			$menus = array_values( $menus );
			$menu  = array_shift( $menus );

			if ( empty( $menu->count ) ) {
				return false;
			}

			return $menu;
		}

		/**
		 * get woo product id by selecting one from database
		 *
		 * @since 1.0.0
		 */
		public function get_woo_product_id() {
			$args = array(
				'post_type'      => 'product',
				'orderby'        => 'name',
				'posts_per_page' => 1,
			);

			$posts = get_posts( $args );

			if ( ! empty( $posts ) ) {
				$this->woo_product_id = $posts[0]->ID;
			}
		}

		/**
		 * get woo product category id by selecting one from database
		 *
		 * @since 1.0.0
		 */
		public function get_woo_product_category_id() {
			$args = array(
				'taxonomy' => 'product_cat',
				'orderby'  => 'name',
				'number'   => 1,
				'fields'   => 'ids',
			);

			$terms = get_terms( $args );

			if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				$this->woo_product_category_id = (int) $terms[0];
			}
		}

		/**
		 * get woo product tag id by selecting one from database
		 *
		 * @since 1.0.0
		 */
		public function get_woo_product_tag_id() {
			$args = array(
				'taxonomy' => 'product_tag',
				'orderby'  => 'name',
				'number'   => 1,
				'fields'   => 'ids',
			);

			$terms = get_terms( $args );

			if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
				$this->woo_product_tag_id = (int) $terms[0];
			}
		}

		/**
		 * get woo product variations by selecting one from database
		 *
		 * @since 1.0.0
		 */
		public function get_woo_taxonomy_attrs() {
			global $wpdb;

			// get term taxonomy id
			$taxonomy_attrs = $wpdb->get_results( "SELECT taxonomy, term_id FROM $wpdb->term_taxonomy WHERE taxonomy LIKE 'pa%' LIMIT 1" );

			if ( ! empty( $taxonomy_attrs ) ) {
				$this->woo_taxonomy = $taxonomy_attrs[0]->taxonomy;
				$this->woo_term_id  = $taxonomy_attrs[0]->term_id;
			}
		}

		/**
		 * add title before block widget
		 *
		 * @param array $blocks - blocks with configuration
		 * @param bool  $group  - add title before block widget to output as group
		 *
		 * @return array
		 *
		 * @since 1.0.0
		 */
		public function group_blocks( $blocks, $group ) {
			$grouped_blocks = array();
			$blocks_group   = array(
				'blockName'    => 'core/group',
				'attrs'        => array(),
				'innerBlocks'  => array(
					array(
						'blockName'    => 'core/heading',
						'innerHTML'    => '',
						'innerContent' => array(
							'',
						),
					),
					array(),
				),
				'innerHTML'    => '<div class="wp-block-group"></div>',
				'innerContent' => array(
					'<div class="wp-block-group">',
					null,
					null,
					'</div>',
				),
				'className'    => '',
			);

			if ( $group ) {
				$count = 0;
				foreach ( $blocks as $block ) {
					$grouped_blocks[ $count ] = $blocks_group;
					// inject title into group
					$grouped_blocks[ $count ]['innerBlocks'][0]['innerHTML']       = '<h2>' . $block['blockHeading'] . '</h2>';
					$grouped_blocks[ $count ]['innerBlocks'][0]['innerContent'][0] = '<h2>' . $block['blockHeading'] . '</h2>';
					// inject block into group
					$grouped_blocks[ $count ]['innerBlocks'][1] = $block;

					$count ++;
				}
			} else {
				$grouped_blocks = $blocks;
			}

			return $grouped_blocks;
		}
	}
}
