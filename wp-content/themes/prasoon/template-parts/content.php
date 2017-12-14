<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package prasoon
 */




if("style1" === esc_attr(get_theme_mod( 'blog_styles' )) && !is_single()) {
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
					<?php
						?>
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

else if("style2" === esc_attr(get_theme_mod( 'blog_styles' )) && !is_single()) {
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

else if(!is_single()) {
	?>
		
		<div class="col-md-6 col-sm-6">
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



/* For single post */
if(is_single()){
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
					<?php
						
						the_title( '<h1 class="entry-title">', '</h1>' );
						
						
						?>
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
							the_content();
					?>					
				</div>		
			</div>
		</article>
	<?php
}
