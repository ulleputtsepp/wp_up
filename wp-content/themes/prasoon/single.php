<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package prasoon
 */

get_header();

?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="page-title">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="entry-title"><?php single_post_title(); ?></h1>
						<div class="bread-crumb">
							<?php if (function_exists('prasoon_custom_breadcrumbs')) prasoon_custom_breadcrumbs(); ?>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<section id="content-page">
			<div class="content-inner">
				<div class="content-blog">
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-sm-6 col-xs-12">
								<div id="primary" class="content-area">
									<?php
									while ( have_posts() ) : the_post();

										get_template_part( 'template-parts/content', get_post_format());

										the_post_navigation();

										// If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										endif;

									endwhile; // End of the loop.
									?>
								</div><!-- #primary -->
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<?php get_sidebar('main-sidebar'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>

<?php
get_footer();
