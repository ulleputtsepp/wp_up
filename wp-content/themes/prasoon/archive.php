<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prasoon
 */


get_header();
?>

<div class="page-title">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
					the_archive_title( '<h1 class="entry-title">', '</h1>' );					
				?>
				<div class="bread-crumb">
					<?php if (function_exists('prasoon_custom_breadcrumbs')) prasoon_custom_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>	
</div>

<div class="content-blog archive">
	<div class="content-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-6 col-xs-12">
					<div id="primary" class="content-area">	
						<?php
						if ( have_posts() ) : ?>						

							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format());

							endwhile;
							?>
								<nav class="pagination">
									<?php the_posts_navigation(); ?>
								</nav>
							<?php

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<?php get_sidebar('main-sidebar'); ?>
				</div>
			</div>		
		</div>
	</div>
</div>

<?php

get_footer();
