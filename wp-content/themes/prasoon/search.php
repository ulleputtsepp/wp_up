<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package prasoon
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="page-title">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="entry-title"><?php _e('SEARCH RESULTS','prasoon') ?></h1>
						<div class="bread-crumb">
							<?php if (function_exists('prasoon_custom_breadcrumbs')) prasoon_custom_breadcrumbs(); ?>
						</div>
					</div>
				</div>
			</div>	
		</div>

		<div class="content-blog searchpage">
			<div class="content-inner">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-sm-6 col-xs-12">
							<div id="primary" class="content-area">
								<?php
								if ( have_posts() ) : ?>

									<div class="search-content">
										<h1 class="page-search"><?php printf( __( 'Search Results for: %s', 'prasoon' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
									</div><!-- .page-header -->

									<?php
									/* Start the Loop */
									while ( have_posts() ) : the_post();

										/**
										 * Run the loop for the search to output the results.
										 * If you want to overload this in a child theme then include a file
										 * called content-search.php and that will be used instead.
										 */
										get_template_part( 'template-parts/content', 'search' );

									endwhile;

									the_posts_navigation();

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
	</main>
</div>

<?php

get_footer();
