<?php 
    /* Template Name: Page full width */
?>
<!-- Hiển thị nội dung trang -->
<!-- Nội dung chi tiết -->
<?php get_header(); ?>
			<div id="content">
				<div class="product-box page-category">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="category-page-content">
                                    <h1 class="cat-title"><?php single_cat_title(); ?></h1>

                                    <?php if (have_posts()) : ?>
                                        <?php while (have_posts()) : the_post(); ?>
                                            <?php setpostview(get_the_ID()); ?>
                                            <h1 class="single-title">
                                                <?php the_title(); ?>
                                            </h1>
                                            <div class="single-content">
                                                <?php the_content(); ?>
                                            </div>                                
                                            <div class="comment-facebook">
                                                <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5"></div>
                                            </div>
                                            <?php comments_template(); ?>
                                        <?php endwhile;?>
                                    <?php endif; ?>
                                </div>
						</div>
					</div>
				</div>
			</div>
<?php get_footer(); ?>