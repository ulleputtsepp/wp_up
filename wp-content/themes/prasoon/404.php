<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
						<h1 class="entry-title"><?php _e('PAGE NOT FOUND','prasoon') ?></h1>
						<div class="bread-crumb">
							<?php if (function_exists('prasoon_custom_breadcrumbs')) prasoon_custom_breadcrumbs(); ?>
						</div>
					</div>
				</div>
			</div>	
		</div>

		<div class="content-page">
			<div class="content-inner">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-sm-6 col-xs-12">
							<div class="content-area">	
								<h1 class="page-error"><?php _e( 'Oops! That page can&rsquo;t be found.', 'prasoon' ); ?></h1>
								<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links on right or a search?', 'prasoon' ); ?></p>
							</div>
						</div>
						<div class="col-md-4 col-sm-6 col-xs-12">
							<?php get_sidebar(); ?>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</main>
</div>

<?php
get_footer();