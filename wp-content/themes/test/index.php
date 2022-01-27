<?php get_header(); ?>
<div id="content">
	<div id="main-content">
		<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
			<?php get_template_part('content', get_post_format()); ?>
		<?php endwhile; ?>
		<?php testwordpress_pagination(); ?>
		<?php else: ?>
			<?php get_template_part('content', 'none'); ?> /* content-none */
		<?php endif; ?>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>