<?php
/**
 * Template Name: Blog Style1
 *
 * Displays the Blog Style 1 Page
 * @package Prasoon
 */

get_header();

?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="page-title">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<div class="bread-crumb">
							<?php if (function_exists('prasoon_custom_breadcrumbs')) prasoon_custom_breadcrumbs(); ?>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<section id="blog-section">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-8">
		            	
						<?php								
							$options = array(
						        'post_type' => 'post',
						        'posts_per_page' => 10							    
						    );

						    $query = new WP_Query( $options );

						    if ( $query->have_posts() ) { 
						    	while ( $query->have_posts() ) {
									$query->the_post();
									$postid = get_the_ID();

									?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<div class="blog-post">
												<div class="image">
													<?php
														if ( has_post_thumbnail()) {
															the_post_thumbnail('full');
														}
													?>
												</div>
																			
												<div class="content">
													<h1 class="entry-title">
														<?php
															if ( is_sticky() && is_home() ) {
																echo "<i class='fa fa-thumb-tack'></i>";
															}
														?>
														<a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a>
													</h1>						
															
													<div class="meta">
														<span class="meta-item"><i class="fa fa-clock-o"></i><?php the_time('F j, Y'); ?></span>
														<span class="meta-item"><i class="fa fa-user"></i><?php the_author() ?></span>
														<span class="meta-item"><i class="fa fa-comments"></i><?php comments_number('0','1','%'); ?></span>
														<span class="meta-item"><i class="fa fa-folder-open"></i><?php the_category(); ?></span>
														<?php
															if(has_tag()){
																?>
																	<span class="meta-item"><i class="fa fa-tag"></i><?php the_tags() ?></span>
																<?php
															}								
														?>
													</div>															
															
													<?php

														the_excerpt( sprintf(
														/* translators: %s: Name of current post. */
														wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'prasoon' ), array( 'span' => array( 'class' => array() ) ) ),
														the_title( '<span class="screen-reader-text">"', '"</span>', false )
														) );
													?>

													<div class="read-more">
														<a href="<?php echo esc_url( get_permalink() ); ?>"><?php _e('READ MORE','prasoon'); ?></a>
													</div>																			
												</div>		
											</div>
										</article>
									<?php
								}
							}							

						?>					
						
					</div>
		            <div class="col-md-4">
		                <?php get_sidebar('main-sidebar'); ?>
		            </div>
		        </div>
		    </div>
		</section>
	</main>
</div>

<?php
get_footer();

?>