<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="entry-thumbnail">
		<?php testwordpress_thumbnail('thumbnail'); ?>
	</div>
	<div class="entry-header">
		<?php testwordpress_entry_header(); ?>
		<?php testwordpress_entry_meta(); ?>
	</div>
	<div class="entry-content">
		<?php testwordpress_entry_content(); ?>
		<?php (is_single() ? testwordpress_entry_tag() : ''); ?>
	</div>
</article>