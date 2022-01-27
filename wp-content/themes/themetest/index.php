<?php get_header(); ?>
<div id="content">
	<div id="main-content">
		<div class="highlight">
			<h1>Bài viết xem nhiều</h1>
			<?php myblog_post_highlight(); ?>
		</div>
		<div class="tatcabai">
			<h1>Tất cả bài viết</h1>
			<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
				<?php get_template_part('content', get_post_format()); ?>
			<?php endwhile; ?>
			<?php testwordpress_pagination(); ?>
			<?php else: ?>
				<?php get_template_part('content', 'none'); ?> /* content-none */
			<?php endif; ?>
		</div>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>