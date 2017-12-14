<?php
/**
 * Template Name: Blog Style2
 *
 * Displays the Blog Style 2 Page
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
		            	<div class="row">
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
											<div class="col-md-4 col-sm-6">
												<div class="blog-wrap wow fadeInUp" data-wow-duration="2s" data-wow-delay="1.5s">
												    <div class="image">
												       	<?php 
												       		if ( has_post_thumbnail()) {
												           		the_post_thumbnail('small');
												       		}
												      		else { 
												       			?>
															        <img src="<?php echo get_template_directory_uri().'/img/blog-bg.jpg' ?>" alt="post-image" /> 
															    <?php
															}
														?>
														<div class="datetime">
															<div class="datetime-section">
															    <h3><?php the_time('j M'); ?></h3>
															    <h4><?php the_time('Y'); ?></h4>
															</div>
														</div>
													</div>
													
													<div class="meta">
														<span class="postedby blogstyle"><i class="fa fa-user"></i><?php the_author() ?></span>
														<span class="comments blogstyle"><i class="fa fa-comments"></i><?php comments_number('0','1','%'); ?>  <?php _e('Comments','prasoon'); ?></span>                          
														<span class="category blogstyle"><i class="fa fa-folder-open"></i><?php the_category(); ?></span>
													</div>

													<div class="heading">
														<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
													</div>
															                        
													<div class="blog-content">
														<p><?php the_excerpt(); ?></p>
														<a class="read-more" href="<?php the_permalink() ?>"><?php _e('READ MORE ','prasoon'); ?><i class="fa fa-plus-circle"></i></a>
													</div>
												</div>
											</div>
										<?php
									}
								}							

							?>
						</div>
						
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