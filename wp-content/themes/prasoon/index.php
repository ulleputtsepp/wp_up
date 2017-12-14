<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prasoon
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
			if(!is_front_page()){
				?>
					<div class="page-title">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<h1 class="entry-title"><?php single_post_title(); ?></h1>
									<div class="bread-crumb">
										<div id="crumbs"><a href="<?php echo home_url(); ?>"><?php _e('Home','prasoon') ?></a> &raquo; <span class="current"><?php _e('Blog','prasoon') ?></span></div>
									</div>
								</div>
							</div>
						</div>	
					</div>			
				<?php
			}

		?>
		
		<div class="content-inner">
			<div id="blog-section">
			    <div class="container">
			        <div class="row">
			            <div class="col-md-8">
							<?php
								if(have_posts() ) {

									if("default" === esc_attr(get_theme_mod( 'blog_styles' )) ||  "style2" === esc_attr(get_theme_mod( 'blog_styles' ))) {
										?>
											<div class="row">
										<?php
									}

									while(have_posts() ) {
										the_post();
										/*
										 * Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'template-parts/content', get_post_format());										
									}

									if("default" === esc_attr(get_theme_mod( 'blog_styles' )) ||  "style2" === esc_attr(get_theme_mod( 'blog_styles' ))) {
										?>
											</div>
										<?php
									}

									?>
			                			<nav class="pagination">
			                    			<?php the_posts_pagination(); ?>
			                			</nav>
									<?php	
								}
								
							?>
			            </div>
			            <div class="col-md-4">
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
