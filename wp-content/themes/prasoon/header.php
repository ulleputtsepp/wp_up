<?php
/**
* The header for our theme.
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package prasoon
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  	<?php
    	if("yes" === esc_attr(get_theme_mod( 'preloader_display','yes' ))) {
      		?>
		        <!-- Begin Preloader -->
		        <div class="loader-wrapper">
		            <div id="pre-loader"></div>
		        </div>
        		<!-- End Preloader -->
      		<?php
    	}
  	?>
  	<!-- Begin Home Section -->
  	<header>
    	<!-- Begin Navbar-->
    	<div id="navigation" class="navbar navbar-default" role="navigation">
      		<div class="container">
        		<div class="row">
          			<div class="navbar-inner">
            			<div class="col-md-3 col-sm-4">
              				<div class="navbar-header">
                				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  					<span class="sr-only"><?php _e( 'Toggle navigation', 'prasoon' ); ?></span>
                    				<i class="fa fa-bars fa-1x"></i>
                				</button>
                				<?php 
                					
                					$sticky_header_logo = esc_url(get_theme_mod( 'sticky_header_logo' ));
                					$theme_content_logo = esc_url(get_theme_mod( 'theme_content_logo' ));

                  					if( is_front_page()) {
                    					prasoon_the_custom_logo();
                    					/* logo for sticky header */                    					
					                    if(!empty($sticky_header_logo)) {
					                      	?>
					                        	<a id="logo-alt" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url( get_theme_mod( 'sticky_header_logo' ) ); ?>" alt="logo-alt"></a>
					                      	<?php
					                    }
					                    else{
					                    	
					                      	if(!empty($theme_content_logo)) {
					                          	?>
					                            	<a id="logo-alt" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url( get_theme_mod( 'theme_content_logo' ) ); ?>" alt="logo-alt"></a>
					                          	<?php
					                        }
					                    }                        
                  					}
                  					else{
				                    	if(!empty($theme_content_logo)) {				                      	 
				                          	if(!empty($sticky_header_logo)) {
				                            	?>
				                              		<a id="logo" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url( get_theme_mod( 'theme_content_logo' ) ); ?>" alt="logo"></a>
				                              		<a id="logo-alt" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url( get_theme_mod( 'sticky_header_logo' ) ); ?>" alt="logo-alt"></a>
				                            	<?php
				                          	}
				                          	else{
				                            	?>
				                              		<a id="logo" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url( get_theme_mod( 'theme_content_logo' ) ); ?>" alt="logo"></a>  
				                              		<a id="logo-alt" href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url( get_theme_mod( 'theme_content_logo' ) ); ?>" alt="logo-alt"></a>  
				                            	<?php 
				                          	}                                                  
				                         
				                    	}                      
				                  	}
				                ?>
				                
				                <h1 class="site-title">
				                  	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_attr(bloginfo( 'name' )); ?></a>
				                </h1> 
				                <?php
				                  	$description = esc_attr(get_bloginfo( 'description', 'display' ));
				                  	if ( $description || is_customize_preview() ) { 
				                  		?>
				                    		<p class="site-description"><?php echo $description; ?></p>
				                  		<?php 
				                  	}
				                ?>
				            </div>
				        </div>
			            <div class="col-md-9 col-sm-8">
			              	<?php
				                wp_nav_menu( array(
				                  'menu'              => '',
				                  'theme_location'    => 'primary',
				                  'depth'             => 2,
				                  'container'         => 'div',
				                  'container_class'   => 'collapse navbar-collapse',
				                  'container_id'      => 'navbar-collapse',
				                  'menu_class'        => 'nav navbar-nav navbar-right',
				                  'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				                  'walker'            => new wp_bootstrap_navwalker())
				                );
			              	?>
			            </div>
			        </div>
			    </div>
			</div>
		</div>                    
		<!-- End Navbar -->
	</header>

	<?php 
		if( is_front_page()) {
			?>		    
				<section id="home">
			      	<?php 
			      		if("slider" != esc_attr(get_theme_mod( 'slide_option1_radio' ))) {
			        		/* check for parallax */
			        		if("yes" === esc_attr(get_theme_mod( 'home_parallax','yes' ))) {
			          		/* show parallax */
			          			?>
			          				<div class="cover-home" data-parallax="scroll" data-image-src="<?php echo esc_url(get_theme_mod( 'theme_home_bg',get_template_directory_uri().'/img/starter-bg.jpg' )); ?>">
			            				<div class="cover-home-overlay"></div> 
			            		<?php
			        		}
			        		else{
			          			/* do not show parallax */
			          			?>
			          				<div class="cover-home" style="background:url('<?php echo esc_url(get_theme_mod( 'theme_home_bg' )); ?>') no-repeat;">
			            				<div class="cover-home-overlay"></div> 
			            		<?php
			        		}

			        		?>		       
			          			<div class="promo-section wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
			            			<div class="container">
			              				<div class="row">
			                				<div class="col-md-12">
			                  					<h2><?php echo esc_attr(get_theme_mod( 'home_heading_text', __('WRITE YOUR HEADING HERE','prasoon')));?></h2>
			                  					<p><?php echo esc_attr(get_theme_mod( 'home_subheading_text', __('change this to your subheading. You can change this in the customizer General Settings section','prasoon')));?></p>
			                  					<div class="learn-more">
			                    					<?php 
			                      						if(""!= esc_attr(get_theme_mod( 'home_button_text' ))) {
			                        						if (false !== strpos(esc_url(get_theme_mod( 'home_button_url' )), 'youtube') || false !== strpos(esc_url(get_theme_mod( 'home_button_url' )), 'vimeo')) {
			                          							?>
			                            							<a data-wow-duration="2s" data-wow-delay="1.5s" class="video-popup-link wow bounceInUp" href="<?php echo esc_url(get_theme_mod( 'home_button_url' ));?>">
			                              								<button id="home-btn1" type="button" class="btn btn-default trans"><?php echo esc_html(get_theme_mod( 'home_button_text' ));?>
			                                								<i class="fa fa-angle-double-right"></i>
			                              								</button>
			                            							</a>
			                          							<?php
			                        						}
			                        						else{
			                          							?>
			                            							<a data-wow-duration="2s" data-wow-delay="1.5s" class="wow bounceInUp" href="<?php echo esc_url(get_theme_mod( 'home_button_url' ));?>">
			                              								<button id="home-btn1" type="button" class="btn btn-default trans"><?php echo esc_html(get_theme_mod( 'home_button_text' ));?>
			                                								<i class="fa fa-angle-double-right"></i>
			                              								</button>                          
			                            							</a>
			                          							<?php
			                        						}                        
			                      						}

			                      						if(""!= esc_attr(get_theme_mod( 'home_button2_text' ))) {
			                        						if (false !== strpos(esc_url(get_theme_mod( 'home_button2_url' )), 'youtube') || false !== strpos(esc_url(get_theme_mod( 'home_button2_url' )), 'vimeo')) {
			                          							?>
			                            							<a data-wow-duration="2s" data-wow-delay="2s" class="video-popup-link wow bounceInUp" href="<?php echo esc_url(get_theme_mod( 'home_button2_url' ));?>">
			                              								<button id="home-btn2" type="button" class="btn btn-default trans"><?php echo esc_html(get_theme_mod( 'home_button2_text' ));?>
			                                								<i class="fa fa-angle-double-right"></i>
			                              								</button>
			                            							</a>
			                          							<?php
			                        						}
			                        						else{
			                          							?>
			                            							<a data-wow-duration="2s" data-wow-delay="2s" class="wow bounceInUp" href="<?php echo esc_url(get_theme_mod( 'home_button2_url' ));?>">
			                              								<button id="home-btn2" type="button" class="btn btn-default trans"><?php echo esc_html(get_theme_mod( 'home_button2_text' ));?>
			                                								<i class="fa fa-angle-double-right"></i>
			                              								</button>                          
			                            							</a>
			                          							<?php
			                        						}                        
			                      						}
			                    					?>     
			                    				</div>                         
			                				</div>
			              				</div>
			             			</div>
			            		</div>
			          		<?php
			            
			              	if("yes" === esc_attr(get_theme_mod( 'home_scroll_down' ))) {
			                	?>
			                		<div class="scroll-down">
			                    		<a data-scroll href="<?php echo esc_url(get_theme_mod( 'scroll_button_url' )); ?>">
			                      			<span></span>
			                      			<span></span>
			                      			<span></span>
			                    		</a>
			                  		</div>
			                	<?php
			              	}
			              	?></div></div><?php
			            }

			        ?>
				</section>
			<?php
		}
	?>                        
		     