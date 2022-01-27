<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="entry-thumbnail">
		<?php myblog_thumbnail('thumbnail'); ?>
	</div>
	<div class="entry-header">
		<?php myblog_entry_header(); ?>
		<?php myblog_entry_meta(); ?>
	</div>
	<div class="entry-content">
		<?php myblog_entry_content(); ?>
		<?php (is_single() ? myblog_entry_tag() : ''); ?>
	</div>
</article>