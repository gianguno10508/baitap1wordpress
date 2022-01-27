<?php get_header(); ?>
<div id="content">
	<div id="main-content">
		<?php
			_e('<h2>404 NOT FOUND</h2>', 'testwordpress');
			_e('<p>The article you were looking for was not found!', 'testwordpress');
			get_search_form();
			_e('<h3>Content categories: </h3>', 'testwordpress');
			echo '<div class="404-cat-list">';
				wp_list_categories(array('title_li'=>''));
			echo '</div>';

			_e('Tag Cloud', 'testwordpress');
			wp_tag_cloud();
		?>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>