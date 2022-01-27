<?php 
	/*
	Template Name: Contact
	*/
?>
<?php get_header(); ?>
<div class="content">
	<div id="main-content">
		<div class="contact-info">
			<h4>Địa chỉ: </h4>
			<p>144 Andress</p>
			<p>01452263345</p>
		</div>
		<div class="contact-form">
			<?php echo do_shortcode('[contact-form-7 id="80" title="Test form"]'); ?>
		</div>
	</div>
	<div id="sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>